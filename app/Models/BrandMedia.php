<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class BrandMedia extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'media_id',
        'brand_id',
    ];

    public function baseMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
