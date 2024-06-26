<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory; use SoftDeletes;

    protected $fillable = [
        'space_id',
        'user_id',
        'message',
        'reply_to',
        'type',
    ];

    public function space()
    {
        return $this->belongsTo(Space::class, 'space_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
