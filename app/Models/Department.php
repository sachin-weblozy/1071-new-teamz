<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'head_id',
        'name',
        'code',
    ];

    public function head()
    {
        return $this->belongsTo(User::class,'head_id','id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
