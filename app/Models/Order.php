<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'user_id',
        'email',
        'phone',
        'zip_code',
        'payment_method',
        'city',
        'address',
        'first_name',
        'last_name',
        'total',
        'status',
        'order_status',
        'payment_status',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'order_no';
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn($total) => $total / 100,
            set: fn($total) => $total * 100,
        );
    }

    public function getNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getFormattedTotalAttribute()
    {
        return money($this->total, config('constants.currency'), true)->formatWithoutZeroes();
    }

    public function getDeliveryTimeAttribute()
    {
        return Carbon::createFromTimestamp(strtotime($this->created_at))->addDays(5)->format("F d, Y");
    }


    public function getFullAddressAttribute()
    {
        return "$this->address, $this->city $this->zip_code";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
