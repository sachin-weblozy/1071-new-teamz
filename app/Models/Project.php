<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be encrypted on save.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'title',
        'url',
        'requirement',
        'deadline',
        'code',
        'teamlead',
        'progress',
        'phase',
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assigned()
    {
        return $this->belongsToMany(User::class)->where('user_id',Auth::id());
    }

    public function spaces()
    {
        return $this->hasMany(Space::class);
    }

    public function events()
    {
        return $this->hasMany(ProjectEvents::class);
    }

    public function lead()
    {
        return $this->belongsTo(User::class,'teamlead','employee_id');
    }
}
