<?php

namespace App\Models\Blog;

use App\User;
use App\Models\Traits\UploadImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;
    use UploadImage;

    public $table = 'blog_posts';

    protected $fillable = [
        'title',
        'user_id',
        'blog_category_id',
        'description',
        'image',
        'published_at'
    ];

    // protected $dates = [
    //     'published_at'
    // ];
    protected $casts = [
        'published_at'=>'datetime'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    public function showImage()
    {
        if (Storage::exists($this->image)) {
            return "storage/$this->image";
        }
        return asset('static/admin/img/default.png');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'blog_category_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where(function () use ($query) {
            $query->whereNull('published_at')
                ->orWhere('published_at', '>', now());
        });
    }

    public function getIsPublishedAttribute()
    {
        return $this->published_at <= now();
    }
}
