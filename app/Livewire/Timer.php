<?php

namespace App\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Timer extends Component
{
    public $signInTime;
    public $onBreak;

    public function mount()
    {
        // Fetch sign-in time for the logged-in user
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();
        
        $attendance = Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->whereNotNull('sign_in')
            ->whereNull('sign_out')
            ->latest('id')
            ->first();

            $this->signInTime = $attendance ? $attendance->sign_in : null;
            $this->onBreak = $attendance ? $attendance->on_break : false;
        
    }

    public function render()
    {
        return view('livewire.timer');
    }
}
