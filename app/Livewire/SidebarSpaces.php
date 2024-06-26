<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectDepartment;
use App\Models\Space;

class SidebarSpaces extends Component
{
    public function render()
    {
        $projects = null;
        $teamlead = null;

        if(Auth::user()->hasRole('superadmin')){

            $projects = Project::get();

        }elseif(Auth::user()->hasRole('user')){

            $user = Auth::user();
            $projects = Project::whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->with(['spaces' => function ($query) use ($user) {
                    $query->whereHas('users', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
                }])
            ->orderBy('id', 'asc')->get();

            foreach($projects as $project){
                if($project->teamlead == Auth::user()->employee_id){
                    $teamlead = 1;
                }
            }
            
        }
        return view('livewire.sidebar-spaces',compact('projects','teamlead'));
    }
}
