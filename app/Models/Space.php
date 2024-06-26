<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Space extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'project_id',
        'name',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function spcusr()
    {
        return $this->belongsToMany(User::class, 'space_user');
    }

    public function assigned()
    {
        return $this->belongsToMany(User::class)->where('user_id',Auth::id());
    }
}
