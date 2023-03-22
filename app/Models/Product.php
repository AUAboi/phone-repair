<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }


    public function media()
    {
        return $this->hasOne(ProductMedia::class);
    }
}
