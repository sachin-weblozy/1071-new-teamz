<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function myAttendance()
    {
        $attendances = Attendance::where([['user_id', '=', Auth::id()]])->latest()->get();
        return view('admin.attendance.index', compact('attendances'));
    }

    public function attendance(Request $request)
    {
        $attendance = Attendance::where([['user_id', '=', Auth::id()],['date', '=', Carbon::now()->format('Y-m-d')]])->first();
        $notes = $request->notes;
        $message = '';

        if($attendance==null){
            $insert = Attendance::create([
                'user_id' => Auth::id(),
                'date' => Carbon::now(),
                'sign_in' => Carbon::now(),
            ]);
            $message = 'You have signed in.';
        }else{
            if($attendance->break_start == null){
                $insert = $attendance->update(
                    [
                        'break_start' => Carbon::now(),
                    ]
                );
                $message = 'You have signed out for Break.';
            }
            elseif($attendance->break_end == null){
                $insert = $attendance->update(
                    [
                        'break_end' => Carbon::now(),
                    ]
                );
                $message = 'You have signed back in.';
            }elseif($attendance->sign_out == null){
                $insert = $attendance->update(
                    [
                        'sign_out' => Carbon::now(),
                        'notes' => $notes,
                    ]
                );
                $message = 'You have signed out.';
            }
        }
        Session::flash('success', $message);
        return redirect()->back();
    }

    public function report($encuserid, $encdate){
        
        $date = Carbon::parse(decrypt($encdate));
        $userid = decrypt($encuserid);
        $user = User::find($userid);
        $completedtasks = Task::where([['assigned_to', '=', $userid]])->whereDate('completed_at', $date)->get();
        $timereport = Attendance::where([['user_id', '=', $userid],['date', '=', $date]])->first();

        if(Auth::user()->hasRole('user')){
            return view('admin.attendance.daily-report', compact('completedtasks','timereport','user','date'));
        }
        if(Auth::user()->hasRole('superadmin')){
            return view('admin.attendance.daily-report', compact('completedtasks','timereport','user','date'));
        }
        
    }
}
