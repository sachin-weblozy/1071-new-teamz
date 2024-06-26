<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMeeting extends Model
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
}
