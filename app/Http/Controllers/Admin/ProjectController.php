<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectDepartment;
use App\Models\Meeting;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ESolution\DBEncryption\Encrypter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if(Auth::user()->hasRole('superadmin')){
            $projects = Project::get();
            $projects->load(['users', 'departments']);
            $projects->loadCount(['departments']);

        }elseif(Auth::user()->hasRole('user')){
            
            $projects = User::find(Auth::id())->assignedProjects()->get();
            $projects->load(['users', 'departments']);
            $projects->loadCount(['departments']);
        }
        
        $departments=Department::get();
        return view('admin.projects.index',compact('projects','departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::get();
        $users = User::get();
        return view('admin.projects.create',compact('departments','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'url' => 'sometimes',
            'requirement' => 'sometimes',
            'deadline' => 'required',
            'department' => 'sometimes|nullable|array',
            'user' => 'sometimes|nullable|array',
            'progress' => 'sometimes|numeric|between:0,100',
        ]);

        $teamlead=null;
        if (isset($data['user'])) {
            foreach($data['user'] as $teamlead){
                $teamleadData = User::find($teamlead);
                $teamlead = $teamleadData->employee_id;
            }
        }

        $progress=0;
        if (isset($data['progress'])) {
            $progress = $data['progress'];
        }

        $project = Project::create([
            'title' => $data['title'],
            'url' => $data['url'],
            'requirement' => $data['requirement'],
            'deadline' => $data['deadline'],
            'teamlead' => $teamlead,
            'progress' => $progress,
        ]);

        if($project){
            Helper::create_project_event($project->id,'created','Project');
        }

        if (isset($data['department'])) {
            $project->departments()->sync($data['department']);
        }
        if (isset($data['user'])) {
            $project->users()->sync($data['user']);
        }
        // foreach($request['department'] as $department){

        //     $pDept = new ProjectDepartment();
        //     $pDept->project_code = $project->id;
        //     $pDept->department_Code = $department;
        //     $deptResult = $pDept->save();
        // }
        Session::flash('success', 'Project Created');
        return to_route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {

        if(Auth::user()->hasRole('user')){
            $isAssigned = $project->assigned()->exists();

            if (!$isAssigned) {
                return redirect()->back()->with('error', 'You are not assigned to this space.');
            }
        }
        
        $project->load(['users', 'departments','spaces']);
        $project->loadCount(['departments']);
        $departments=Department::get();
        $users = User::get();
        $meetings = Meeting::where('project_id', $project->id)->get();
        $spaces = $project->spaces;
        return view('admin.projects.show', compact('project','departments','users','meetings','spaces'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load(['users', 'departments']);
        $project->loadCount(['departments']);
        $departments=Department::get();
        $users = User::get();
        return view('admin.projects.edit', compact('project','departments','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required',
            'url' => 'required',
            'requirement' => 'sometimes',
            'deadline' => 'required',
            'department' => 'sometimes|nullable|array',
            'user' => 'sometimes|nullable|array',
            'teamlead' => 'sometimes',
            'progress' => 'sometimes|numeric|between:0,100',
        ]);

        
        $teamlead=null;
        if (isset($data['teamlead'])) {
            $teamlead = $data['teamlead'];
        }else{
            $teamlead = $project['teamlead'];
        }

        $progress=$project->progress;
        if (isset($data['progress'])) {
            $progress = $data['progress'];
        }

        $result = $project->update(
            [
                'title' => $data['title'],
                'url' => $data['url'],
                'requirement' => $data['requirement'],
                'deadline' => $data['deadline'],
                'teamlead' => $teamlead,
                'progress' => $progress,
            ]
        );

        if($result){
            Helper::create_project_event($project->id,'updated','Project');
        }

        if (isset($data['department'])) {
            $project->departments()->sync($data['department']);
        }else {
            $project->departments()->sync([]);
        }
        if (isset($data['user'])) {
            $project->users()->sync($data['user']);
        }else {
            $project->users()->sync([]);
        }
        Session::flash('success', 'Project Updated');
        return to_route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->departments()->sync([]);
        $project->users()->sync([]);
        $result = $project->delete();
        if($result){
            Helper::create_project_event($project->id, 'deleted', 'Project');
            Session::flash('success', 'Project Deleted');
            return to_route('admin.projects.index');
        }else{
            Session::flash('error', 'An error occured');
            return to_route('admin.projects.index');
        }
    }

    public function fetchCrmProjects(){
        $projects= Http::post('https://crm.weblozy.co/api/project-to-tms', ['token'=>'W3blozy@2024'])->json('projects');
        $existing = Project::get();
        dd($projects);
        return view('admin.projects.crm_import', compact('projects','existing'));
    }

    public function importCrmProjects($empID){
        // $userData=null;
        // $projects= Http::post('https://crm.weblozy.co/api/project-to-tms', ['token'=>'W3blozy@2024'])->json('projects');
        // foreach($projects as $project){
        //     if($user['employee_id']==$empID){
        //         $userData=$user;
        //     }
        // }

        // $existing = User::where('email',$userData['email'])
        //                 ->orWhere('phone',$userData['phone'])
        //                 ->orWhere('employee_id',$userData['employee_id'])
        //                 ->orWhere('eid',$userData['eid'])
        //                 ->exists();
        
        // if(!$existing){
        //     $type=0; if($userData['is_admin']==1){ $type=1;}
        //     $result = User::create([
        //         'name' => $userData['name'],
        //         'email' => $userData['email'],
        //         'phone' => $userData['phone'],
        //         'password' => Hash::make('password'),
        //         'employee_id' => $userData['employee_id'],
        //         'eid' => $userData['eid'],
        //         'type' => $type,
        //         'department_code' => $userData['department_code'],
        //         'avatar' => $userData['profile_photo_url'],
        //     ]);
        //     if($result){
        //         Session::flash('success', 'User Imported');
        //         return to_route('admin.users.index');
        //     }
            
        // }else{
        //     dd('already exist');
        //     // return redirect()->back();
        // }

        // return view('admin.users.crm_import', compact('users','existing'));
    }

    public function timeline($project_id)
    {   
        $project = Project::where('id',$project_id)->first();
        return view('admin.projects.timeline',compact('project'));
    }

    public function meetingsList($project_id)
    {   
        $project = Project::where('id',$project_id)->first();
        $project->load(['users']);
        $meetings = Meeting::where('project_id', $project->id)->get();
        return view('admin.projects.meetings',compact('project','meetings'));
    }

    public function meetingCreate(Request $request)
    {   
        $data = $request->validate([
            'project_id' => 'required',
            'title' => 'required',
            'description' => 'sometimes',
            'url' => 'sometimes',
            'start_at' => 'required',
            'end_at' => 'required',
            'members' => 'sometimes|nullable|array',
        ]);

        $meeting = Meeting::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'description' => $request->description,
            'meeting_url' => $request->url,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);
        
        if (isset($data['members'])) {
            $meeting->users()->sync($data['members']);
        }
        
        if($meeting){
            Session::flash('success', 'Meeting Created');
        }else{
            Session::flash('error', 'An error occured');
        }

        Session::flash('success', 'Meeting Created');
        return to_route('admin.projects.show', $request->project_id);
    }

    public function meetingDestroy($meeting_id)
    {
        $meeting=Meeting::where('id', $meeting_id)->first();
        // $meeting->departments()->sync([]);
        // $project->users()->sync([]);
        $result = $meeting->delete();
        if($result){
            Helper::create_project_event($meeting->project_id, 'deleted', 'Meeting');
            Session::flash('success', 'Meeting Deleted');
        }else{
            Session::flash('error', 'An error occured');
        }
        return redirect()->back();
    }

    public function meetingNotes(Request $request)
    {
        $meeting=Meeting::where('id', $request->meeting_id)->first();

        $result = $meeting->update(
            [
                'notes' => $request->notes,
            ]
        );
        if($result){
            Helper::create_project_event($meeting->project_id, 'added', 'Notes');
            Session::flash('success', 'Meeting Note Added');
        }else{
            Session::flash('error', 'An error occured');
        }
        return redirect()->back();
    }
}
