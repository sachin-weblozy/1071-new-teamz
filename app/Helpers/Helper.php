<?php

namespace App\Helpers;

use App\Models\Department;
use App\Models\Project;
use App\Models\ProjectEvents;
use App\Models\Space;
use App\Models\Task;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Helper {

    public static function getSpaceCount(){
        $count = Space::count();
        return $count;
    }

    public static function getProjectCount(){
        $count = Project::count();
        return $count;
    }

    public static function getTaskCount(){
        $count = Task::count();
        return $count;
    }

    public static function getTodoCount(){
        $count = Todo::count();
        return $count;
    }

    public static function getUserCount(){
        $count = User::count();
        return $count;
    }

    public static function getUserSpaceCount($userid){
        $user = User::findOrFail($userid);
        $count = $user->spaces()->count();
        return $count;
    }

    public static function getUserProjectCount($userid){
        $user = User::findOrFail($userid);
        $count = $user->projects()->count();
        return $count;
    }

    public static function getUserTaskCount($userid){
        $count = Task::where([['assigned_to', '=', $userid],['completed_at', '=', null]])->count();
        return $count;
    }

    public static function getUserTodoCount($userid){
        $count = Todo::where([['user_id', '=', $userid],['completed_at', '=', null]])->count();
        return $count;
    }

    public static function getUserTaskList($userid){
        $tasks = Task::where([['assigned_to', '=', $userid],['completed_at', '=', null]])->get();
        return $tasks;
    }

    public static function getDateTime($dateString){
        if($dateString){
            $dateTimestamp = strtotime($dateString);
            $date = date('j M, Y', $dateTimestamp);
            $time = date('h:i A', $dateTimestamp);
    
            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime('+1 day'));
            $yesterday = date('Y-m-d', strtotime('-1 day'));
    
            // Format the date part of $dateTimestamp to 'Y-m-d'
            $dateOnly = date('Y-m-d', $dateTimestamp);
    
            // Check if the date is today, tomorrow, or yesterday
            if ($dateOnly == $today) {
                $label = 'Today - '.$time;
            } elseif ($dateOnly == $tomorrow) {
                $label = 'Tomorrow - '.$time;
            } elseif ($dateOnly == $yesterday) {
                $label = 'Yesterday - '.$time;
            } else {
                // If it's not today, tomorrow, or yesterday, display the date
                $label = $date.' - '.$time;
            }
            
            return $label;
        } else {
            return null;
        }
    }
    

    public static function formatDate($dateString){
        if($dateString){
            $date = date('j M, Y', strtotime($dateString));
        return $date;
        }else{
            return null;
        }
    }

    public static function formatTime($dateString){
        if($dateString){
            $time = date('h:i A', strtotime($dateString));
            return $time;
        }else{
            return null;
        }
    }

    public static function create_project_event($project_id, $type, $model){
        $event = ProjectEvents::create([
            'project_id' => $project_id,
            'user_id' => Auth::id(),
            'type' => $type,
            'model' => $model,
        ]);
    }

    public static function admin_lead_access($userid) {
        $access = false;
        $user = Auth::user();
        
        if ($user->hasRole('superadmin')) {
            $access = true;
        } else {
            // Check if the user is a team lead and the specified user is in their team
            $isTeamLead = Team::where('lead_id', $user->id)
                ->whereHas('users', function ($query) use ($userid) {
                    $query->where('users.id', $userid);
                })
                ->exists();
    
            // Check if the user is the head of a department and the specified user is in one of the teams under that department
            $isDepartmentHead = Department::where('head_id', $user->id)
                ->whereHas('teams.users', function ($query) use ($userid) {
                    $query->where('users.id', $userid);
                })
                ->exists();
            
            if ($isTeamLead || $isDepartmentHead) {
                $access = true;
            }
        }
        
        return $access;
    }
    

    public static function bodysidebarmenu(){
        if(Route::is('admin.spaces.*') || Route::is('admin.users.*') || Route::is('admin.department.*') || Route::is('admin.teams.*') || Route::is('admin.crmuser.list')){
            return '';
        }else{
            return 'mini-sidebar';
        }
    }

    public static function themeSetting(){
        
    }
}