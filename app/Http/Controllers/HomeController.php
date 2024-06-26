<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewFeed;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        event(new MyEvent('This is testing data'));
        return view('welcome');
    }

    public function redirectUser(){

        if(auth()->user()->hasRole('superadmin')){
            return redirect()->route('admin.dashboard');
        }

        if(auth()->user()->hasRole('user')){
            return redirect()->route('admin.dashboard');
        }

    }
}
