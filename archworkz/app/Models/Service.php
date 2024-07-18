<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\UploadImage;
use Cviebrock\EloquentSluggable\Sluggable;

class Service extends Model
{

    protected $fillable = ['title', 'description'];

}