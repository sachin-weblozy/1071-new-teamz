<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'space_id',
        'title',
        'assigned_by',
        'assigned_to',
        'assign_date',
        'deadline',
        'status',
        'notes',
        'priority',
        'recurrence',
        'parent_id',
        'completed_at',
        'created_at',
        'updated_at',
    ];

    public function assignedto()
    {
        return $this->belongsTo(User::class,'assigned_to','id');
    }

    public function assignedby()
    {
        return $this->belongsTo(User::class,'assigned_by','id');
    }

    public function space()
    {
        return $this->belongsTo(Space::class,'space_id','id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'parent_id', 'id');
    }
    public function task()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function scopeDueTodayOrOverdue($query, $userId)
    {
        $today = Carbon::today()->toDateString();

        return $query->where('assigned_to', $userId)
            ->whereNull('completed_at')
            ->where(function ($query) use ($today) {
                $query->where(function ($query) use ($today) {
                    $query->where('recurrence', '0')
                          ->whereDate('deadline', '=', $today); // Non-recurring tasks due today
                })->orWhere(function ($query) use ($today) {
                    $query->whereDate('deadline', '<', $today)
                          ->where('recurrence', '0'); // Non-recurring tasks overdue
                })->orWhere(function ($query) use ($today) {
                    $query->whereDate('deadline', '=', $today)
                          ->where('recurrence', '<>', '0'); // Recurring tasks due today
                });
            })
            ->orderBy('deadline', 'asc');
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDurationAttribute()
    {
        if ($this->completed_at && $this->created_at) {
            $createdAt = Carbon::parse($this->created_at);
            $completedAt = Carbon::parse($this->completed_at);
            return $completedAt->diffInSeconds($createdAt); // Duration in seconds
        }

        return null; // If either timestamp is missing
    }

    public function getDurationInHumanReadableAttribute()
    {
        if ($this->completed_at && $this->created_at) {
            $createdAt = Carbon::parse($this->created_at);
            $completedAt = Carbon::parse($this->completed_at);
            return $completedAt->diffForHumans($createdAt, true); // Human-readable format
        }

        return null; // If either timestamp is missing
    }
    
    // public function saveQuietly()
    // {
    //     return static::withoutTask(function () {
    //         return $this->save();
    //     });
    // }
}
