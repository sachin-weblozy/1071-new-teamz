<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\FaqController;
use App\Http\Controllers\User\FileController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\VideoController;

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

// Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:user']], function () {
//     Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');
//     Route::resource('tickets', TicketController::class);
//     Route::resource('files', FileController::class);
//     Route::resource('videos', VideoController::class);
//     Route::get('faqs', [FaqController::class, 'index'])->name('faqs.index');
//     Route::get('faqs/{catid}', [FaqController::class, 'show'])->name('faqs.show');
//     Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
//     Route::get('reports/{id}', [ReportController::class, 'show'])->name('reports.show');
//     Route::get('tickets/{id}/comments', [TicketController::class, 'showComments'])->name('tickets.showComments');
//     Route::put('tickets/{id}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
//     Route::get('unsolved-tickets', [TicketController::class, 'unsolved'])->name('tickets.unsolved');
//     Route::get('solved-tickets', [TicketController::class, 'solved'])->name('tickets.solved');
//     Route::get('/fetch-specs/{id}/', [TicketController::class, 'fetchSpecs'])->name('tickets.fetchSpecs');
//     Route::get('/fetch-subspecs/{id}/', [TicketController::class, 'fetchSubSpecs'])->name('tickets.fetchSubSpecs');

// });