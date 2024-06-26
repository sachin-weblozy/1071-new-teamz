<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lead_id',
        'department_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function assigned()
    {
        return $this->belongsToMany(User::class)->where('user_id',Auth::id());
    }

    public function lead()
    {
        return $this->belongsTo(User::class,'lead_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function dept()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

    // public function activeUsers()
    // {
    //     return $this->belongsToMany(User::class)->where('user_id',Auth::id())->where();
    // }
}
