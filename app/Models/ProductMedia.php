<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductMedia extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'media_id',
        'product_id',
    ];

    public function baseMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
