<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'device_repair_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'zip_code',
        'city',
        'address',
        'appointment_date',
        'appointment_time'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone' => E164PhoneNumberCast::class . ':PK'
    ];
}
