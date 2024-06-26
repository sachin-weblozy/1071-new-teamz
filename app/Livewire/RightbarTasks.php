<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RightbarTasks extends Component
{
    public function render()
    {
        $tasks = Task::where([['assigned_to', '=', Auth::id()],['completed_at', '=', null]])->get();
        return view('livewire.rightbar-tasks',compact('tasks'));
    }
}
