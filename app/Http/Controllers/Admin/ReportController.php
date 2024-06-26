<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Task;
use App\Models\Attendance;
use App\Models\Report;
use App\Models\Team;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class ReportController extends Controller
{
    public function myreport()
    {
        $userid = Auth::id();
        $user = User::where('id',$userid)->first();
        $attendances = Attendance::where([['user_id', '=', $userid]])->orderBy('date','DESC')->get()->filter(function($user1) {
            return Carbon::parse($user1->date)->isMonday();
        });
        $type = 'weekly';
        $today = Carbon::now();
        $isFriday = $today->dayOfWeek === Carbon::FRIDAY;

        $access = Helper::admin_lead_access($user->id);
        
        return view('admin.report.index',compact('attendances','user','type','isFriday','access'));
    }
    
    public function weekList($encuserid)
    {
        $userid = decrypt($encuserid);
        $user = User::where('id',$userid)->first();
        $attendances = Attendance::where([['user_id', '=', $userid]])->orderBy('date','DESC')->get()->filter(function($user1) {
            return Carbon::parse($user1->date)->isMonday();
        });
        $type = 'weekly';
        $today = Carbon::now();
        $isFriday = $today->dayOfWeek === Carbon::FRIDAY;

        $access = Helper::admin_lead_access($user->id);
        
        return view('admin.report.index',compact('attendances','user','type','isFriday','access'));
    }

    public function weeklyShow($encuserid,$encdate)
    {
        $userid = decrypt($encuserid);
        $decryptedDate = decrypt($encdate);

        $startDate = Carbon::parse($decryptedDate);
        $endDate = Carbon::parse($decryptedDate)->addDays(4);

        $user = User::where('id',$userid)->first();
        $attendances = Attendance::where([['user_id', '=', $userid]])->whereBetween('created_at', [$startDate, $endDate])->orderBy('date','DESC')->get();

        $report = Report::where([['user_id', '=', $userid], ['type', '=', 'weekly'], ['start_date', '=', $startDate]])->first();

        $type = 'weekly';

        $totalTasks = Task::where([['assigned_to', '=', $userid]])->whereBetween('created_at', [$startDate, $endDate])->get();
        $completedTasks = Task::where([['assigned_to', '=', $userid],['completed_at', '!=', null]])->whereBetween('created_at', [$startDate, $endDate])->get();
        $pendingTasks = Task::where([['assigned_to', '=', $userid],['completed_at', '=', null]])->whereBetween('created_at', [$startDate, $endDate])->get();

        $totalWorkingHours = 0;
        $totalBreakHours = 0;

        foreach ($attendances as $attendance) {
            $signIn = Carbon::parse($attendance->sign_in);
            $signOut = Carbon::parse($attendance->sign_out);
            $breakStart = $attendance->break_start ? Carbon::parse($attendance->break_start) : null;
            $breakEnd = $attendance->break_end ? Carbon::parse($attendance->break_end) : null;

            // Calculate the difference in minutes between sign in and sign out
            $workingMinutes = $signOut->diffInMinutes($signIn);

            // Calculate break time in minutes if break_start and break_end are present
            if ($breakStart && $breakEnd) {
                $breakMinutes = $breakEnd->diffInMinutes($breakStart);
            } else {
                $breakMinutes = 0;
            }

            // Subtract break time from working minutes
            $workingMinutes -= $breakMinutes;

            // Convert minutes to hours
            $workingHours = $workingMinutes / 60;
            $breakHours = $breakMinutes / 60;

            // Add the working hours and break hours for this record to the total
            $totalWorkingHours += $workingHours;
            $totalBreakHours += $breakHours;
        }

        $totalWorkingHours = number_format($totalWorkingHours, 2);
        $totalBreakHours = number_format($totalBreakHours, 2);

        // Initialize variables for total duration and task count
        $totalDuration = 0;
        $totalEfficiency = 0;
        $taskCount = $completedTasks->count();
        $dailyCompletedTasksPercentage = [];

        // Calculate the total duration and efficiency
        foreach ($completedTasks as $task) {
            $createdAt = Carbon::parse($task->created_at);
            $completedAt = Carbon::parse($task->completed_at);
            $deadline = Carbon::parse($task->deadline);

            // Calculate actual duration in seconds
            $actualDuration = $completedAt->diffInSeconds($createdAt);

            // Calculate target duration in seconds
            $targetDuration = $deadline->diffInSeconds($createdAt);

            // Avoid division by zero and calculate efficiency
            if ($actualDuration > 0) {
                $efficiency = ($targetDuration / $actualDuration) * 100;
                $totalEfficiency += $efficiency;
            }

            $totalDuration += $actualDuration;

            // Calculate the completed tasks percentage for each day
            $completedDate = Carbon::parse($task->completed_at)->format('Y-m-d');
            if (!isset($dailyCompletedTasksPercentage[$completedDate])) {
                $dailyCompletedTasksPercentage[$completedDate] = 0;
            }
            $dailyCompletedTasksPercentage[$completedDate]++;
        }

        // Calculate average efficiency
        $averageEfficiency = $taskCount > 0 ? $totalEfficiency / $taskCount : 0;
        $averageEfficiency = number_format($averageEfficiency, 0);
        // Calculate average duration
        $averageDuration = $taskCount > 0 ? $totalDuration / $taskCount : 0;

        return view('admin.report.weekly',compact('attendances','user', 'report','type','startDate','endDate','totalTasks','completedTasks','pendingTasks','averageEfficiency','dailyCompletedTasksPercentage','totalWorkingHours','totalBreakHours'));
    }

    public function storeReport(Request $request)
    {
        $data = $request->validate([
            'userid' => 'required',
            'start_date' => 'required',
            'type' => 'required',
            'rating' => 'required',
            'description' => 'sometimes',
        ]);

        $user = User::find($request->userid);
        
        $report = Report::create([
            'user_id' => $user->id,
            'start_date' => $request->start_date,
            'type' => $request->type,
            'rating' => $request->rating,
            'description' => $request->description,
        ]);

        $report = Report::updateOrCreate(
            ['user_id' => $user->id, 'type' => $request->type, 'start_date' => $request->start_date],
            ['user_id' => $user->id, 'type' => $request->type, 'start_date' => $request->start_date, 'rating' => $request->rating, 'description' => $request->description]
        );

        if($report){
            Session::flash('success', 'Report Updated');
            return redirect()->back();
        }

    }
}
