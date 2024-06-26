<?php

namespace App\Livewire;

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SpaceChat extends Component
{
    public $chats;
    public $newMessage;
    public $space_id;

    public function mount($space_id)
    {
        $this->chats = Chat::where('space_id',$space_id)->get();
        $this->newMessage = null;
        $this->space_id = $space_id;
    }

    public function sendMessage()
    {
        if($this->newMessage){
            $result = Chat::create([
                'space_id' => $this->space_id,
                'user_id' => Auth::user()->id,
                'message' => $this->newMessage,
            ]);
            
            $this->newMessage = '';
            $this->chats = Chat::where('space_id',$this->space_id)->get();
            $this->dispatch('sendMessage');
            $this->dispatch('notify');
        }
    }

    public function notify()
    {
        return view('livewire.space-chat');
    }

    public function render()
    {
        return view('livewire.space-chat');
    }

}
