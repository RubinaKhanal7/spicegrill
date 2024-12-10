<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Category extends Model
{
    use HasFactory;
    use Sluggable;


    public function sluggable():array{
        return [
            'slug' => [
                'source' => 'title'
            ]
            ];
    }

    public function getPosts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }
}
