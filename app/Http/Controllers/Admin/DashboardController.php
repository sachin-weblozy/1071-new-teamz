<?php

namespace App\Http\Controllers\Admin;

use App\Events\TaskNotify;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\Attendance;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Report;
use App\Models\Task;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function home(){
        
        $report = Report::where([['user_id', '=', Auth::id()], ['type', '=', 'weekly']])->first();
        $today = Carbon::now()->format('l'); // Get today's day in full name, e.g., "Monday"
        $dayMsg1 = '';
        $dayMsg2 = '';

        switch ($today) {
            case 'Monday':
                $dayMsg1 = "Good Morning ".Auth::user()->name;
                $dayMsg2 = "We missed you. Ready for a fresh start? New week, new goals.";
                break;
            case 'Tuesday':
                $dayMsg1 = "Radhe Radhe";
                $dayMsg2 = "Tuesday’s here! Time to turn those to-dos into ta-das.";
                break;
            case 'Wednesday':
                $dayMsg1 = "Good day.";
                $dayMsg2 = "Halfway there! Let’s win this Wednesday!";
                break;
            case 'Thursday':
                $dayMsg1 = "Hi you curious head.";
                $dayMsg2 = "Almost at the finish line. You've got this bro!";
                break;
            case 'Friday':
                $dayMsg1 = "Morning's Good.";
                $dayMsg2 = "Friday gives you wings. Let’s wrap up strong!";
                break;
            case 'Saturday':
                $dayMsg1 = "Happy Weekend.";
                $dayMsg2 = "Rise and shine. Don't whine! Tomorrow's Sunday.";
                break;
            case 'Sunday':
                $dayMsg1 = "Relax and Recharge.";
                $dayMsg2 = "Enjoy your Sunday before the new week starts.";
                break;
            default:
                $dayMsg1 = "Hello!";
                $dayMsg2 = "Have a great day!";
                break;
        }
        
        if(Auth::user()->hasRole('superadmin')){
            $projects = Project::where('progress', '<', 100)->get();
            $projects->load(['users', 'departments']);
            $projects->loadCount(['departments']);
            $meetings=Meeting::get();
            $tasks=Task::get();
            $users = User::with('getTodayTasks','lastReport')->get();
            $now = Carbon::now()->toDateTimeString();
            
            return view('admin.home',compact('projects','meetings','report','dayMsg1','dayMsg2','tasks','users','now'));

        }elseif(Auth::user()->hasRole('user')){
            
            $projects = User::find(Auth::id())->assignedProjects()->where('progress', '<', 100)->get();
            $projects->load(['users', 'departments']);
            $projects->loadCount(['departments']);
            $meetings=Meeting::get();
            return view('admin.userhome',compact('projects','meetings','report','dayMsg1','dayMsg2'));
        }

        
    }

}
