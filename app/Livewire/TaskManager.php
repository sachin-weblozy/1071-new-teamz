<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskComplete;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskManager extends Component
{
    public $tasks;
    public $taskId;
    public $completedTasks;
    public $task;
    public $title;
    public $priority;
    public $deadline;
    public $recurrence;
    public $completed;
    public $today;
    public $now;
    public $homepage;

    public function mount()
    {
        $this->today = Carbon::today()->toDateString();
        $this->now = Carbon::now()->toDateTimeString();
        $this->loadTasks();
        
        if(Route::is('admin.dashboard')){
            $this->homepage=1;
        }else{
            $this->homepage=0;
        }
    }

    public function loadTasks()
    {
        $today = $this->today;
        $now = Carbon::now()->toDateTimeString();
        $this->tasks = Task::where([['assigned_to', '=', Auth::id()],['completed_at', '=', null]])
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
        
        $this->completedTasks = Task::where([['assigned_to', '=', Auth::id()]])->whereDate('completed_at', $today)->orderBy('completed_at', 'asc')->get();
        
        $this->today = $today;
        $this->now = $now;
        $today = $this->today;
        $title = $this->title;
        $deadline = $this->deadline;
        $priority = $this->priority;
        $recurrence = $this->recurrence;
        $completedTasks = $this->completedTasks;
    }

    public function toggleStatus($taskId)
    {

        $task = Task::where('id',$taskId)->first();
        
        if($task->completed_at != null){
            $task->completed_at = null;
        }else{
            $task->completed_at = Carbon::now();
            
            if($task->space_id !=0){
                $url = route('admin.spaces.show',$task->space_id);
            }else{
                $url = route('admin.tasks.index');
            }

            $fullname = explode(" ", $task->assignedto->name);
            $assignedto = $fullname[0];
            
            $data = [
                'task_title' => $task->title,
                'assigned_to' => $assignedto,
                'url' => $url,
            ];
            $notifyToUser = User::find($task['assigned_by']);
            $notifyToUser->notify(new TaskComplete($notifyToUser->id, $data));
        }

        $task->save();

        $this->loadTasks();
    }


    public function createTask()
    {
        $today = Carbon::now();
        
        if ($this->recurrence != 0) {

            $endTime = Carbon::parse($this->deadline)->endOfDay(); // Ensure the deadline is the end of the day
            $startTime = Carbon::now();
            $parent = null; 
            $i=1;
            while ($startTime <= $endTime) {
                $deadlineNew = $startTime->copy()->startOfDay();
                if ($this->recurrence == 'weekly') {
                    // If current day is past the deadline, break the loop
                    if ($deadlineNew->gt($endTime)) {
                        break;
                    }
                } elseif ($this->recurrence == 'monthly') {
                    
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
                    'space_id' => 0,
                    'title' => $this->title,
                    'assigned_by' => Auth::id(),
                    'assigned_to' => Auth::id(),
                    'assign_date' => $startTime,
                    'deadline' => $deadlineNew,
                    'parent_id'    => $parent,
                    'recurrence' => $this->recurrence,
                    'priority' => $this->priority,
                    'status' => 0,
                ]);

                if($i==1){
                    $parent = $task->id;
                }
                $i++;

                // Move to the next occurrence
                if ($this->recurrence == 'daily') {
                    $startTime->addDay();
                } elseif ($this->recurrence == 'weekly') {
                    $startTime->next($startTime->dayName);
                } elseif ($this->recurrence == 'monthly') {
                    $startTime->addMonth();
                }
            }
        } 
        
        if ($this->recurrence == 0){
            
            $task = Task::create([
                'space_id' => 0,
                'title' => $this->title,
                'assigned_by' => Auth::id(),
                'assigned_to' => Auth::id(),
                'assign_date' => Carbon::now(),
                'deadline' => $this->deadline,
                'recurrence' => $this->recurrence,
                'priority' => $this->priority,
                'status' => 0,
            ]);
        }

        Session::flash('success', 'Task Created');
    }

    public function markAsRead()
    {
        // Mark notifications as read
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function editTask($taskId)
    {
        // Logic to edit a task
    }

    public function deleteTask($taskId)
    {
        // Logic to delete a task
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
