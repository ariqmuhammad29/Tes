<?php

namespace App\Models;

use App\User;
use App\Models\Traits\UploadImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use Sluggable;
    use UploadImage;

    public $table = 'pages';

    protected $fillable = [
        'title',
        'description',
        'image'
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

    public function showImage ()
    {
        if (Storage::exists($this->image)) {
            return "storage/$this->image";
        }
        return asset('static/admin/img/default.png');
    }
    
}