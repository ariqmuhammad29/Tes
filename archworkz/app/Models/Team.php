<?php

namespace App\Models;

use App\Models\Traits\UploadImage;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Cviebrock\EloquentSluggable\Sluggable;;

class Team extends Model implements Sortable
{
    use SortableTrait;
    use Sluggable;
    use UploadImage;

    protected $fillable = [
        'name',
        'role',
        'about',
        'image',
        'slug'
    ];


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
