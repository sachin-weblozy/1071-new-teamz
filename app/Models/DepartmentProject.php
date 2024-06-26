<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'project_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
}
