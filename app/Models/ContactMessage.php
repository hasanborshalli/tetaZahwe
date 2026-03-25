<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'event_type',
        'event_date',
        'message',
        'is_read',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_read'    => 'boolean',
    ];
}
