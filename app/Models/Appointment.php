<?php

namespace App\Models;

use App\Services\AppointmentService;
use Carbon\Carbon;
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
        'device_repair_title',
        'device_repair_price',
        'payment_status',
        'payment_method',
        'device_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'zip_code',
        'city',
        'message',
        'address',
        'appointment_date',
        'appointment_time',
        'total',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone' => E164PhoneNumberCast::class . ":GB",
    ];


    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn($value) => phone($value)->formatForCountry(config('constants.phone_number')),
        );
    }


    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn($price) => $price / 100,
            set: fn($price) => $price * 100,
        );
    }

    protected function getIdentifierAttribute()
    {
        $appointmentService = new AppointmentService();
        return  $appointmentService->generateIdentifier($this);
    }

    public function getFormattedTotalAttribute()
    {
        return money($this->total, config('constants.currency'), true)->formatWithoutZeroes();
    }


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

    public function deviceRepair()
    {
        return $this->belongsTo(DeviceRepair::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%');
            })
                ->orWhere('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('appointment_number', 'like', '%' . $search . '%');
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->where('status', 'like', '%' . $status . '%');
        });
    }
}
