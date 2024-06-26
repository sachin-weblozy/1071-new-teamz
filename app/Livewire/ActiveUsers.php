<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class ActiveUsers extends Component
{
    public $activeUsers;

    public function mount()
    {
        $today = Carbon::today()->toDateString();
        $this->activeUsers = User::whereHas('attendances', function ($query) use ($today) {
            $query->whereDate('date', $today)
                  ->whereNotNull('sign_in')
                  ->whereNull('sign_out');
        })->get();

    }

    public function render()
    {
        return view('livewire.active-users');
    }
}
