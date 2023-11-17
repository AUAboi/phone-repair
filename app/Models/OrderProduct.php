<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
