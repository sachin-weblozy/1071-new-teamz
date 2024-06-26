<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Settings extends Component
{
    public function toggleTheme($newTheme)
    {
        $user = Auth::user();
        $user->theme = $newTheme;
        $user->save();
        return redirect(request()->header('Referer'));
    }

    public function toggleDirection($newDir)
    {
        $user = Auth::user();
        $user->layout = $newDir;
        $user->save();
        return redirect(request()->header('Referer'));
    }

    public function toggleColor($newColor)
    {
        $user = Auth::user();
        $user->color = $newColor;
        $user->save();
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
