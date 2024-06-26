<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'password',
        'avatar',
        'department_code',
        'employee_id',
        'eid',
        'theme',
        'color',
        'layout',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_code','code');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user')->withTimestamps();
    }

    public function assignedProjects()
    {
        return $this->belongsToMany(Project::class);
    }
    
    public function assignedMeetings()
    {
        return $this->belongsToMany(Meeting::class);
    }
    
    public function assignedSpaces()
    {
        return $this->belongsToMany(Space::class);
    }

    public function assignedTeams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function spaces()
    {
        return $this->belongsToMany(Space::class, 'space_user')->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    
    public function likedFeeds()
    {
        return $this->belongsToMany(Feed::class, 'feed_likes');
    }

    public function postedFeeds()
    {
        return $this->hasMany(Feed::class,'user_id');
    }

    public function headedDepartments()
    {
        return $this->hasMany(Department::class, 'head_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user');
    }

    public function ledTeams()
    {
        return $this->hasMany(Team::class, 'lead_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to', 'id');
    }

    public function getTodayTasks()
    {
        $today = Carbon::today()->toDateString();

        return $this->tasks()
            ->whereNull('completed_at')
            ->where(function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->where('recurrence', 'none')
                          ->whereDate('deadline', '=', $today); // Non-recurring tasks due today
                })->orWhere(function ($query) use ($today) {
                    $query->whereDate('deadline', '<', $today)
                          ->where('recurrence', 'none'); // Non-recurring tasks overdue
                })->orWhere(function ($query) use ($today) {
                    $query->whereDate('deadline', '=', $today)
                          ->where('recurrence', '<>', 'none'); // Recurring tasks due today
                });
            })
            ->orderBy('deadline', 'asc');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function lastReport()
    {
        return $this->hasOne(Report::class)->latest();
    }
    
}
