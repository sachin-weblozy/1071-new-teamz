<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'sign_in',
        'break_start',
        'break_end',
        'sign_out',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
