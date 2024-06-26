<?php

use App\Events\TaskNotify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [HomeController::class,'index']);

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/',[HomeController::class,'redirectUser'])->name('dashboard');
    Route::get('/dashboard',[HomeController::class,'redirectUser'])->name('admin.dashboard');
    Route::get('user/profile', [ProfileController::class, 'show'])->name('profile.show');
});
