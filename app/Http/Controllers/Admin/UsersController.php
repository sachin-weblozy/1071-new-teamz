<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Task;
use App\Models\Attendance;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User Read|User Create|User Edit|User Delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:User Create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:User Edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:User Delete', ['only' => ['destroy']]);
    }

    protected function getDefaultGuardName(): string { return 'web'; }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments=Department::get();
        $roles = Role::get();
        return view('admin.users.create', compact('departments','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:10|max:15',
            'password' => 'required',
            'department' => 'sometimes',
        ]);

        $result = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'department' => $request->department,
        ]);

        $result->syncRoles($request->roles);

        if ($result) {
            Session::flash('success', 'User Created');
            return to_route('admin.users.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user=User::where('id',decrypt($id))->first();
        $departments=Department::get();
        $roles = Role::get();
        return view('admin.users.show', compact('user','departments','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::where('id',decrypt($id))->first();
        $departments=Department::get();
        $roles = Role::get();
        return view('admin.users.edit', compact('user','departments','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:15',
            'department' => 'sometimes',
        ]);

        $result = $user->update(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'department' => $request->department,
            ]
        );

        $user->syncRoles($request->roles);
        
        if($result){
            Session::flash('success', 'User Updated');
            return to_route('admin.users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result = $user->delete();
        if($result){
            Session::flash('success', 'User Deleted');
            return to_route('admin.users.index');
        }
    }

    public function fetchCrmUsers(){
        $users= Http::post('https://crm.weblozy.co/api/user-to-tms', ['token'=>'W3blozy@2023'])->json('users');
        $existing = User::get();
        return view('admin.users.crm_import', compact('users','existing'));
    }

    public function importCrmUser($empID){
        $userData=null;
        $users= Http::post('https://crm.weblozy.co/api/user-to-tms', ['token'=>'W3blozy@2023'])->json('users');
        foreach($users as $user){
            if($user['employee_id']==$empID){
                $userData=$user;
            }
        }

        $existing = User::where('email',$userData['email'])
                        ->orWhere('phone',$userData['phone'])
                        ->orWhere('employee_id',$userData['employee_id'])
                        ->orWhere('eid',$userData['eid'])
                        ->exists();
        
        if(!$existing){
            $type=0; if($userData['is_admin']==1){ $type=1;}
            $result = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'phone' => $userData['phone'],
                'password' => Hash::make('password'),
                'employee_id' => $userData['employee_id'],
                'eid' => $userData['eid'],
                'type' => $type,
                'department_code' => $userData['department_code'],
                'avatar' => $userData['profile_photo_url'],
            ]);
            if($result){
                Session::flash('success', 'User Imported');
                return to_route('admin.users.index');
            }
            
        }else{
            dd('already exist');
            // return redirect()->back();
        }

        // return view('admin.users.crm_import', compact('users','existing'));
    }

    

    public function calendar($encuserid){
        $userid = decrypt($encuserid);
        $events = [];
        $user = User::where('id',$userid)->first();
        $tasks = Task::where([
            ['assigned_to', '=', $userid],
            ['completed_at', '=', null],
        ])->get();

        $project = null; $i=0;
        foreach ($tasks as $task) {
            if($i==1){break;}
            if($task->space != null){
                $project = $task->space->project->id;
            }
            $i++;
        }
        $color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        foreach ($tasks as $task) {
            if($project != null){
                if($project != $task->space->project->id){
                    $color = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                }
                $project = $task->space->project->id;
                $events[] = [
                    'title' => $task->space->project->title.' - '.$task->title,
                    'start' => $task->assign_date,
                    'end' => $task->deadline,
                    'color' => $color,
                ];
            }
        }
        
       return view('admin.users.calendar',compact('events','user'));
    }

    public function getcalendar(Request $request){

        if($request->ajax()) {
       
            $data = Task::where('assign_date', '>=', $request->start)
                      ->whereDate('deadline',   '<=', $request->end)
                      ->get(['id', 'title', 'assign_date', 'deadline']);
 
            return response()->json($data);
       }
 
       return view('admin.users.calendar');
    }

    public function attendance($encuserid)
    {
        $userid = decrypt($encuserid);
        $user = User::where('id',$userid)->first();
        $attendances = Attendance::where([['user_id', '=', $userid]])->orderBy('date','DESC')->paginate(12);
        return view('admin.users.attendance',compact('attendances','user'));
    }

    

    public function tasks($encuserid)
    {
        $userid = decrypt($encuserid);
        $user = User::where('id',$userid)->first();
        $today = Carbon::today()->toDateString();

        $tasks = Task::where([['assigned_to', '=', $userid],['completed_at', '=', null]])
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

        $completedTasks = Task::where([['assigned_to', '=', $userid]])->whereDate('completed_at', $today)->orderBy('completed_at', 'asc')->get();

        return view('admin.users.tasks',compact('tasks','user','completedTasks'));
    }
}

