<?php

namespace App\Models\Portofolio;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\UploadImage;
use App\User;

class Portofolio extends Model
{
    use Sluggable;
    use UploadImage;
    protected $fillable = ['title', 'client_id', 'portofolio_category_id', 'status', 'description', 'image'];

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
        return $this->hasOne(CategoryPortofolio::class, 'id', 'portofolio_category_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(Portofolio_image::class, 'portfolio_id', 'id');
    }
}
