<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mycalendar(){
       return view('admin.calendar.index');
    }

    public function fetchCalendar(){
        $userid = Auth::id();
        $events = [];
        $user = User::where('id',$userid)->first();
    
        // Fetch tasks
        $tasks = Task::where('assigned_to', $userid)->get();
    
        // Fetch meetings
        $meetings = Meeting::where('project_id', $user->project_id)->get();
    
        foreach ($tasks as $task) {
            $events[] = [
                'id' => $task->id,
                'title' => $task->space ? $task->space->project->title.' - '.$task->title : $task->title,
                'start' => $task->assign_date,
                'end' => $task->deadline,
                'extendedProps' => ['calendar' => $this->getRandomExtendedProp()],
            ];
        }
    
        foreach ($meetings as $meeting) {
            $events[] = [
                'id' => $meeting->id,
                'title' => $meeting->title,
                'start' => $meeting->start_at,
                'end' => $meeting->end_at,
                'extendedProps' => ['calendar' => $this->getRandomExtendedProp()],
            ];
        }
    
        return response()->json(['events' => $events]);
    }
    
    private function getRandomExtendedProp() {
        $extendedPropsOptions = ['Danger', 'Success', 'Primary', 'Warning'];
        $randomIndex = array_rand($extendedPropsOptions);
        return $extendedPropsOptions[$randomIndex];
    }
    
    
    
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Task::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Task::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Task::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
}
