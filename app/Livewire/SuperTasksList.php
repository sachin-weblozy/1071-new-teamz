<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SuperTasksList extends Component
{
    public $selectedUser = null;
    public $users = [];
    public $now = [];

    public function mount()
    {
        $this->users = User::with('getTodayTasks')->get();
        $this->now = Carbon::now()->toDateTimeString();
        // dd($this->users);
    }

    public function render()
    {
        return view('livewire.super-tasks-list');
    }
}
