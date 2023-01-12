<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeviceRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_id',
        'device_id',
        'price',
        'title',
        'body'
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($price) => $price / 100,
            set: fn ($price) => $price * 100,
        );
    }

    public function getFormattedPriceAttribute()
    {
        return money($this->price, config('constants.currency'), true)->formatWithoutZeroes();
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
