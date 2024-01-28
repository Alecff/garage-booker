<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'vehicle_make_model',
        'booking_datetime',
    ];

    protected $casts = [
        'booking_datetime' => 'datetime',
    ];
}
