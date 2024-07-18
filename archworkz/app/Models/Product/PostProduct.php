<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Traits\UploadImage;
use Illuminate\Support\Facades\Storage;

class PostProduct extends Model
{
    use HasFactory;
    use Sluggable;
    // use UploadImage;

    public $table = 'product_posts';

    protected $fillable = [
        'title',
        'user_id',
        'project_name',
        'designer',
        'location',
        'status',
        'slug',
        'description',
    ];

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

    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id', 'id');
    }
}
