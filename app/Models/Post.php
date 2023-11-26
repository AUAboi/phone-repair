<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'author',
        'user_id',
        'status',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function media()
    {
        return $this->hasOne(PostMedia::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query
                ->where('title', 'like', '%' . $search . '%');
        });
    }

    public function scopePublishedPosts($query)
    {
        $query
            ->where('status', '=',  'published');
    }

    public function getSummaryAttribute()
    {
        $content = Str::words(strip_tags($this->body), 20, '...');
        return str_replace('&nbsp;', ' ', $content);
    }
}
