<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        $users=User::get();
        
        // Fetch meetings assigned to the current user
        $meetings = Meeting::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        
        // Optionally, you can eager load users to avoid N+1 problem
        $meetings->load('users');
        
        return view('admin.meetings.index', compact('meetings','users'));
    }
}
