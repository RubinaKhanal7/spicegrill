<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    use Sluggable;


    public function sluggable():array{
        return [
            'slug'=> [
                'source'=>'title'
            ]
            ];
    }

    public function getCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'posts_categories');
    }

    
}
