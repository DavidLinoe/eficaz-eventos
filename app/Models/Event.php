<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'capacity',
        'status',
        'starts_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
    ];
}
