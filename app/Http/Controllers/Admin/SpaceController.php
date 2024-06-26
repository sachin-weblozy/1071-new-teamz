<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Space;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Space Read|Space Create|Space Edit|Space Delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Space Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Space Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Space Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('superadmin')){
            $spaces = Space::get();
            $projects = Project::get();
        }
        if(Auth::user()->hasRole('user')){
            $spaces = Space::whereHas('assigned')->get();
            $projects = Project::whereHas('assigned')->get();
        }
        
        $spaces->load(['project']);
        $users = User::get();
        return view('admin.spaces.index',compact('projects','users','spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('superadmin')){
            $projects = Project::get();
        }
        if(Auth::user()->hasRole('user')){
            $projects = Project::whereHas('assigned')->get();
        }
        $users = User::get();
        
        return view('admin.spaces.create',compact('projects','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'sometimes|nullable',
            'project' => 'required',
        ]);

        $user = [Auth::id()];
        
        $space = Space::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'project_id' => $data['project'],
        ]);

        if($space){
            Helper::create_project_event($data['project'], 'created', 'Space');
        }

        if (isset($user)) {
            $space->users()->sync($user);
        }

        if($space){
            Session::flash('success', 'Space Created');
            return to_route('admin.spaces.show', $space->id);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Space $space)
    {
        if(Auth::user()->hasRole('user')){
            $isAssigned = $space->assigned()->exists();

            if (!$isAssigned) {
                return redirect()->back()->with('error', 'You are not assigned to this space.');
            }
        }
        
        $project = Project::whereHas('spaces', function ($query) use ($space) {
            $query->where('id', $space->project_id);
        })->firstOrFail();
        $project->load(['users', 'departments']);
        $users = User::get();
        
        $today = Carbon::today()->toDateString();

        $tasks = Task::where([['space_id', '=', $space->id],['completed_at', '=', null]])
                        ->where(function ($query) use ($today) {
                            $query->where(function ($query) use ($today) {
                                $query->where('recurrence', '0'); // Non-recurring tasks due today
                            })->orWhere(function ($query) use ($today) {
                                $query->whereDate('deadline', '<', $today) // Deadline has passed
                                    ->where('recurrence', '0'); // Non-recurring tasks overdue
                            })->orWhere(function ($query) use ($today) {
                                $query->whereDate('deadline', $today) // Deadline is today
                                    ->where('recurrence', '<>', '0'); // Recurring tasks due today
                            });
                        })
                        ->orderBy('deadline', 'asc') // Order by deadline ascending
                        ->get();
        return view('admin.spaces.show', compact('project','space','users','tasks'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        if(Auth::user()->hasRole('superadmin')){
            $projects = Project::get();
        }
        if(Auth::user()->hasRole('user')){
            $projects = Project::whereHas('assigned')->get();
        }
        $users = User::get();
        
        return view('admin.spaces.edit',compact('space','projects','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'sometimes|nullable',
            'project' => 'required',
        ]);

        $result = $space->update(
            [
                'name' => $data['name'],
                'description' => $request->description,
                'project' => $data['project'],
            ]
        );

        if($result){
            Helper::create_project_event($space->project_id,'updated','Space');
            Session::flash('success', 'Space Updated');
        }else{
            Session::flash('error', 'An error occured!');
        }

        return to_route('admin.spaces.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        $space->users()->sync([]);
        $result = $space->delete();
        if($result){
            Helper::create_project_event($space->project_id, 'deleted', 'Project');
            Session::flash('success', 'Space Deleted');
            return to_route('admin.spaces.index');
        }else{
            Session::flash('error', 'An error occured');
            return to_route('admin.spaces.index');
        }
    }

    public function addMember($id)
    {   
        $space = Space::where('id',$id)->first();
        $project = Project::where('id',$space->project_id)->first();
        $project->load(['users', 'departments']);

        return view('admin.spaces.addmembers',compact('project','space'));
    }

    public function storeMember(Request $request)
    {   
        $data = $request->validate([
            'spaceid' => 'required',
            'members' => 'sometimes|nullable',
        ]);

        $space = Space::where('id',$data['spaceid'])->first();

        if (isset($data['members'])) {
            $space->users()->sync($data['members']);
        }else{
            $space->users()->sync([]);
        }

        Helper::create_project_event($space->project_id, 'added/updated members', 'Space');
        
        Session::flash('success', 'Space Updated');
        return to_route('admin.spaces.show', $space->id);
    }

    public function calendar($spaceid, $encuserid){
        $userid = decrypt($encuserid);
        $events = [];
        $user = User::where('id',$userid)->first();
        $tasks = Task::where([
            ['space_id', '=', $spaceid],
            ['assigned_to', '=', $userid],
            ['completed_at', '=', null],
        ])->get();

        foreach ($tasks as $appointment) {
            $events[] = [
                'title' => $appointment->space->project->title.' - '.$appointment->title,
                'start' => $appointment->assign_date,
                'end' => $appointment->deadline,
            ];
        }
       return view('admin.spaces.calendar',compact('events','user'));
    }
    public function updateTaskStatus(Request $request)
    {
        $data = $request->validate([
            'task_id' => 'required',
            'status' => 'required',
        ]);
        $task = Task::where('id',$data['task_id'])->first();

        if($data['status']=='true'){
            $result = $task->update(
                [
                    'completed_at' => Carbon::now(),
                ]
            );
            if($result){
                if($task->space_id){
                    Helper::create_project_event($task->space->project_id, 'completed', 'Task');
                }
            }
        }
        if($data['status']=='false'){
            $result = $task->update(
                [
                    'completed_at' => null,
                ]
            );
            if($result){
                if($task->space_id){
                    Helper::create_project_event($task->space->project_id, 'incompleted', 'Task');
                }
            }
        }
    }
}

