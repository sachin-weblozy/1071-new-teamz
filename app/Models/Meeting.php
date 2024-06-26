<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'start_at',
        'end_at',
        'meeting_url',
        'notes',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assigned()
    {
        return $this->belongsToMany(User::class)->where('user_id',Auth::id());
    }
}
