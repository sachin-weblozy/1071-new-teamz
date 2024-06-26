<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notes extends Component
{
    public $notes;
    public $noteId;

    public function mount()
    {
        $this->notes = Note::where([['user_id', '=', Auth::id()]])->latest()->get();
    }

    public function toggleFavorite($noteId)
    {
        $note = Note::findOrFail($noteId);
        $note->starred = !$note->starred;
        $note->save();

        // Update the database with 1 if marked as starred, 0 if removed from starred
        $note->starred ? $note->update(['starred' => 1]) : $note->update(['starred' => 0]);
    }

    public function deleteNote($noteId)
    {
        $note = Note::findOrFail($noteId);
        $note->delete();
        
        // Remove the deleted note from the array of notes
        $this->notes = $this->notes->reject(function ($item) use ($noteId) {
            return $item->id == $noteId;
        });
    }

    public function render()
    {
        return view('livewire.notes');
    }
}
