<?php

use App\Events\TaskNotify;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\NotesController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SpaceController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TodoController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\FeedController;
use Illuminate\Support\Facades\Route;
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

Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:user|superadmin']], function () {
    Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');
    // Route::get('/dashboard', [DashboardController::class, 'home'])->name('home');

    Route::resource('notes', NotesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('meetings', MeetingsController::class);
    Route::resource('teams', TeamController::class);
    Route::get('/my-attendance', [AttendanceController::class, 'myAttendance'])->name('myattendance');
    Route::get('/my-team', [TeamController::class, 'myTeam'])->name('myteam.index');
    Route::get('/my-team/{id}', [TeamController::class, 'myTeamShow'])->name('myteam.show');
    Route::get('/my-report', [ReportController::class, 'myReport'])->name('myreport');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/crm-users', [UsersController::class, 'fetchCrmUsers'])->name('crmuser.list');
    Route::get('/crm-users/{empID}/import', [UsersController::class, 'importCrmUser'])->name('crmuser.import');
    // departments 
    // Route::get('/departments', [AdminController::class, 'showDepartments'])->name('department.list');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/create-department', [DepartmentController::class, 'store'])->name('department.store');
    Route::post('/update-department', [DepartmentController::class, 'update'])->name('department.update');

    Route::resource('projects', ProjectController::class);
    Route::get('projects/{id}/timeline', [ProjectController::class, 'timeline'])->name('projects.timeline');
    Route::get('projects/{id}/meetings', [ProjectController::class, 'meetingsList'])->name('projects.meetings');
    Route::post('create-meetings', [ProjectController::class, 'meetingCreate'])->name('projects.createMeeting');
    Route::post('create-meetings-notes', [ProjectController::class, 'meetingNotes'])->name('projects.meetingNotes');
    Route::delete('delete-meeting/{meeting_id}', [ProjectController::class, 'meetingDestroy'])->name('projects.meeting.destroy');
    Route::get('/crm-projects', [ProjectController::class, 'fetchCrmProjects'])->name('crmprojects.list');
    Route::get('/crm-projects/{projectID}/import', [ProjectController::class, 'importCrmProjects'])->name('crmprojects.import');

    Route::resource('spaces', SpaceController::class);
    Route::resource('feeds', FeedController::class);
    Route::resource('todos', TodoController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('tasks', TaskController::class);
    // Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::post('/update-todos', [TodoController::class, 'update'])->name('todos.updatetodo');
    Route::get('/spaces/{id}/members', [SpaceController::class, 'addMember'])->name('spaces.addmembers');
    Route::post('spaces/members', [SpaceController::class, 'storeMember'])->name('spaces.storemembers');
    Route::post('spaces/addtask', [TaskController::class, 'store'])->name('spaces.addtask');
    Route::post('spaces/updatetask', [TaskController::class, 'update'])->name('spaces.updatetask');
    Route::post('spaces/deletetask', [TaskController::class, 'destroy'])->name('spaces.deletetask');
    Route::get('spaces/{id}/users/{userid}/calendar', [SpaceController::class, 'calendar'])->name('spaces.users.calendar');
    Route::get('users/{id}/calendar', [UsersController::class, 'calendar'])->name('users.calendar');
    Route::get('users/{id}/attendance', [UsersController::class, 'attendance'])->name('users.attendance');
    Route::get('users/{id}/tasks', [UsersController::class, 'tasks'])->name('users.tasks');

    Route::post('update-report', [ReportController::class, 'storeReport'])->name('userreport.store');
    Route::get('report/user/{userid}/weekly', [ReportController::class, 'weekList'])->name('userreport.weekly');
    Route::get('report/user/{userid}/weekly/{date}', [ReportController::class, 'weeklyShow'])->name('userreport.weekly.show');
    Route::get('report/user/{userid}/monthly', [ReportController::class, 'monthList'])->name('userreport.monthly');
    
    Route::get('getcalendar', [UsersController::class, 'getcalendar'])->name('users.getcalendar');
    Route::get('/calendar', [CalendarController::class, 'mycalendar'])->name('calendar');
    Route::get('/fetch-calendar', [CalendarController::class, 'fetchCalendar'])->name('fetch-calendar');
    Route::get('user/report/{encuserId}/{encdate}', [AttendanceController::class, 'report'])->name('report');
    // Route::resource('projects/{id}/view', [ProjectController::class, 'view']);

    Route::get('/test', [TaskController::class, 'test'])->name('test');
    // Route::get('getcalendar', [FullCalenderController::class, 'index']);
    

});

Route::post('fullcalenderAjax', [CalendarController::class, 'ajax']);
Route::post('/update-todostatus', [TodoController::class, 'updateStatus'])->name('todos.todostatus');
Route::post('/update-taskstatus', [SpaceController::class, 'updateTaskStatus'])->name('tasks.taskstatus');
Route::post('/attendance', [AttendanceController::class, 'attendance'])->name('attendance');

// routes/web.php
