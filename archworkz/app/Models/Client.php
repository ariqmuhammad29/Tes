<?php

namespace App\Models;

use App\Models\Traits\UploadImage;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;

class Client extends Model implements Sortable
{
    use SortableTrait;
    use UploadImage;
    
    protected $fillable = [
        'name',
        'email',
        'image',
        'phone',
        'about',
        'address',
        'additional_info'
    ];

}
