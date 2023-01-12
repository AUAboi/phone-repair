<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => phone($value)->formatForCountry(config('constants.phone_number')),
        );
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone' => E164PhoneNumberCast::class . ':PK'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
}
