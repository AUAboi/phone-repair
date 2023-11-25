<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'product_id',
        'order_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedPriceAttribute()
    {
        return money($this->price, config('constants.currency'), true)->formatWithoutZeroes();
    }

    public function getFormattedTotalAttribute()
    {
        return money($this->price * $this->quantity, config('constants.currency'), true)->formatWithoutZeroes();
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
