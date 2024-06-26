<?php

namespace App\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AttendanceRecorder extends Component
{
    public $buttonLabel;
    public $buttonClass;
    public $notes;
    public $message;
    public $allowSignOff = false;
    public $showModal = false;
    public $showButton = true;

    public function mount()
    {
        $this->determineButtonState();
        $this->notes = '';
        $this->message = '';
    }

    public function determineButtonState()
    {
        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['date', '=', Carbon::now()->format('Y-m-d')]
        ])->first();

        if ($attendance && $attendance->sign_out) {
            $this->showButton = false;
            $this->buttonLabel = '';
            $this->buttonClass = '';
        } else {
            $this->showButton = true;
            $this->buttonLabel = $this->getButtonLabel();
            $this->buttonClass = $this->getButtonClass();
        }

        if ($attendance) {
            if($attendance->sign_in !=null && $attendance->break_start !=null && $attendance->break_end !=null){
                $this->allowSignOff = 1;
            }
            if($attendance->sign_in !=null && $attendance->break_start !=null && $attendance->break_end !=null && $attendance->sign_out !=null){
                $this->allowSignOff = 2;
            }
        }
    }

    public function getButtonLabel()
    {
        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['date', '=', Carbon::now()->format('Y-m-d')]
        ])->first();

        if ($attendance) {
            if ($attendance->sign_out) {
                return 'Sign In';
            } elseif (!$attendance->break_start) {
                return 'Break Start';
            } elseif (!$attendance->break_end) {
                return 'Break End';
            } else {
                return 'Sign Out';
            }
        }

        return 'Sign In';
    }

    public function getButtonClass()
    {
        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['date', '=', Carbon::now()->format('Y-m-d')]
        ])->first();

        if ($attendance) {
            if ($attendance->sign_out) {
                return 'btn-primary';
            } elseif (!$attendance->break_start) {
                return 'btn-success';
            } elseif (!$attendance->break_end) {
                return 'btn-primary';
            } else {
                return 'btn-success';
            }
        }else{
            return 'btn-primary';
        }

        return 'Sign In';
    }

    public function handleButtonClick()
    {
        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['date', '=', Carbon::now()->format('Y-m-d')]
        ])->first();

        if (!$attendance) {
            Attendance::create([
                'user_id' => Auth::id(),
                'date' => Carbon::now()->format('Y-m-d'),
                'sign_in' => Carbon::now(),
            ]);
            $this->message = 'You have signed in.';
        } else {
            if (!$attendance->break_start) {
                $attendance->update(['break_start' => Carbon::now()]);
                $this->message = 'You have signed out for Break.';
            } elseif (!$attendance->break_end) {
                $attendance->update(['break_end' => Carbon::now()]);
                $this->message = 'You have signed back in.';
            }
            
        }

        $this->determineButtonState();
    }

    public function signOut()
    {
        dd($this->notes);
        $attendance = Attendance::where([
            ['user_id', '=', Auth::id()],
            ['date', '=', Carbon::now()->format('Y-m-d')]
        ])->first();

        if ($attendance && !$attendance->sign_out) {
            $attendance->update([
                'sign_out' => Carbon::now(),
                'notes' => $this->notes,
            ]);
            $this->message = 'You have signed out.';
            $this->showModal = false;
        }

        $this->determineButtonState();
    }

    public function cancelSignOut()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.attendance-recorder');
    }
}
