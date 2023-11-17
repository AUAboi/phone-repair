<?php

namespace App\Models;

use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'email',
        'phone',
        'zip_code',
        'city',
        'address',
        'first_name',
        'last_name',
        'total',
        'status',
    ];


    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($total) => $total / 100,
            set: fn ($total) => $total * 100,
        );
    }

    public function getFormattedTotalAttribute()
    {
        return money($this->total, config('constants.currency'), true)->formatWithoutZeroes();
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
