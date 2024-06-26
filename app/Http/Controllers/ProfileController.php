<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function edit(){
        return view('profile.edit');
    }
    public function show(){

        $userid = Auth::user()->id;
        $user = User::where('id',$userid)->first();
        $departments=Department::get();
        return view('profile.show', compact('user','departments'));
    }
}
