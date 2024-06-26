<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskNotify;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\User;
use App\Models\Project;
use App\Models\Space;
use App\Models\Task;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Chat;
use App\Notifications\NewTask;
use Illuminate\Support\Facades\Session;
use PHPUnit\TextUI\Help;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::get();
        $users = User::get();
        return view('admin.spaces.create',compact('projects','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'spaceid' => 'required',
            'assignTo' => 'required',
            'deadline' => 'required',
            'priority' => 'required',
            'recurrence' => 'required',
        ]);

        $today = Carbon::now();

        if ($data['recurrence'] != 0) {

            $endTime = Carbon::parse($data['deadline']);
            $startTime = Carbon::now();
            $parent = null; 
            $i=1;
            
            while ($startTime <= $endTime) {
                $deadlineNew = $startTime;
                
                if ($data['recurrence'] == 'weekly') {
                    // If current day is past the deadline, break the loop
                    if ($deadlineNew->gt($endTime)) {
                        break;
                    }
                } elseif ($data['recurrence'] == 'monthly') {
                    
                    $deadlineNew->day($startTime->day); // Set next occurrence to the same day of the month
                    if ($deadlineNew->lt($startTime)) {
                        $deadlineNew->addMonthNoOverflow(); // Handle edge case where next month doesn't have the same day
                    }
                    // If current day is past the deadline, break the loop
                    if ($deadlineNew->gt($endTime)) {
                        break;
                    }
                }
                
                $task = Task::create([
                    'space_id' => $data['spaceid'],
                    'title' => $data['title'],
                    'assigned_by' => Auth::id(),
                    'assigned_to' => $data['assignTo'],
                    'assign_date' => $startTime,
                    'deadline' => $deadlineNew,
                    'parent_id'    => $parent,
                    'recurrence' => $data['recurrence'],
                    'priority' => $data['priority'],
                    'status' => 0,
                ]);

                if($i==1){
                    $parent = $task->id;
                }
                $i++;

                // Move to the next occurrence
                if ($data['recurrence'] == 'daily') {
                    $startTime->addDay();
                } elseif ($data['recurrence'] == 'weekly') {
                    $startTime->next($startTime->dayName);
                } elseif ($data['recurrence'] == 'monthly') {
                    $startTime->addMonth();
                }
            }
        } 

        if ($data['recurrence'] == 0){
            
            $task = Task::create([
                'space_id' => $data['spaceid'],
                'title' => $data['title'],
                'assigned_by' => Auth::id(),
                'assigned_to' => $data['assignTo'],
                'assign_date' => Carbon::now(),
                'deadline' => $data['deadline'],
                'recurrence' => $data['recurrence'],
                'priority' => $data['priority'],
                'status' => 0,
            ]);
        }

        if ($task) {

            if($data['spaceid'] != 0){
                $sendchat = Chat::create([
                    'space_id' => $data['spaceid'],
                    'user_id' => Auth::user()->id,
                    'message' => " Task: " . $data['title'],
                    'type' => 'task',
                ]);
    
                $notifyToUser = User::find($data['assignTo']);
                $notifyToUser->notify(new NewTask($notifyToUser->id, $task));

                Helper::create_project_event($task->space->project_id, 'created', 'Task');
            }
            
            
            Session::flash('success', 'Task Created');
        }else{
            Session::flash('success', 'Failed');
        }
        
        if($data['spaceid']==0){
            return redirect()->route('admin.tasks.index');
        }else{
            return redirect()->route('admin.spaces.show', $data['spaceid'])->with(['taskcheck' => 1]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'taskid' => 'required',
            'assignTo' => 'required',
            'deadline' => 'required',
            'priority' => 'required',
            'futurecheck' => 'sometimes',
        ]);

        $selected = Task::where('id',$request->taskid)->first();
        $selectedid=null;
        if($selected->parent_id==null){
            $selectedid = $selected->id;
        }else{
            $selectedid = $selected->parent_id;
        }

        if(isset($data['futurecheck'])){
            $parseNewTime = Carbon::parse($data['deadline']);
            $newTime = Carbon::createFromTime($parseNewTime->hour, $parseNewTime->minute, $parseNewTime->second);
            $oldDeadline = Carbon::parse($selected->deadline);
            $newDeadline = $oldDeadline->setTime($newTime->hour, $newTime->minute, $newTime->second);


            $result = Task::where('id',$selected->id)->update(
                        [
                            'title' => $data['title'],
                            'assigned_to' => $data['assignTo'],
                            'priority' => $data['priority'],
                            'deadline' => $newDeadline,
                        ]
                    );
            $futuretasks = Task::where('parent_id',$selectedid)
                    ->whereDate('assign_date', '>', $selected->assign_date)
                    ->get();
            foreach($futuretasks as $futuretask){

                $parseNewTime1 = Carbon::parse($data['deadline']);
                $newTime1 = Carbon::createFromTime($parseNewTime1->hour, $parseNewTime1->minute, $parseNewTime1->second);
                $oldDeadline1 = Carbon::parse($futuretask->deadline);
                $newDeadline1 = $oldDeadline1->setTime($newTime->hour, $newTime->minute, $newTime->second);

                $result = $futuretask->update(
                    [
                        'title' => $data['title'],
                        'assigned_to' => $data['assignTo'],
                        'priority' => $data['priority'],
                        'deadline' => $newDeadline1,
                    ]
                );
            }
            
        }
        else{
            $result = $selected->update(
                [
                    'title' => $data['title'],
                    // 'assigned_to' => $data['assignTo'],
                    'deadline' => $data['deadline'],
                    'priority' => $data['priority'],
                ]
            );
        }


        if($result){
            if($selected->space_id !=0 ){
                Helper::create_project_event($selected->space->project_id, 'updated', 'Task');
            }
            $taskcheck=1;
            Session::flash('success', 'Task Updated');
            return redirect()->back()->with('success', 'Task Updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $selected = Task::where('id',$request->taskid)->first();
        $selectedid=null;
        if($selected->parent_id==null){
            $selectedid = $selected->id;
        }else{
            $selectedid = $selected->parent_id;
        }

        if($request->allcheck==0){
            $result = Task::where('id',$request->taskid)->delete();
        }elseif($request->allcheck==1){
            $result = Task::where('id',$selected->id)->delete();
            $result = Task::where('parent_id',$selectedid)
                    ->whereDate('assign_date', '>', $selected->assign_date)
                    ->delete();
        }
        if($result){
            if($selected->space_id !=0){
                Helper::create_project_event($selected->space->project_id, 'deleted', 'Task');
            }
            $taskcheck=1;
            Session::flash('success', 'Task Deleted');
            return redirect()->back()->with('success', 'Task Deleted.');
        }
    }

    public function test(){

        $events = [];
 
        $tasks = Task::where('id',1)->get();
//  dd($tasks); 
        foreach ($tasks as $appointment) {
            $events[] = [
                'title' => $appointment->title,
                'start' => $appointment->assign_date,
                'end' => $appointment->deadline,
            ];
        }
//  dd($events);
        return view('test', compact('events'));
    }
}
