<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationList extends Component
{
    public $notifications;

    public function mount()
    {
        $user = Auth::user();
        $this->notifications = $user->unreadNotifications;
    }

    public function clearNotifications()
    {
        $user = Auth::user();
        Auth::user()->notifications()->delete();
        $this->notifications = $user->unreadNotifications;
    }

    public function render()
    {
        return view('livewire.notification-list');
    }
}
