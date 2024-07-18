<?php

namespace App\Models\Portofolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CategoryPortofolio extends Model
{
    use Sluggable;
    use HasFactory;
    public $table = 'portofolio_categories';

    protected $fillable = ['name', 'description'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }
}
