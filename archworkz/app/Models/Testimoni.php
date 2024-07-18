<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\UploadImage;

class Testimoni extends Model
{
    use UploadImage;

    protected $fillable = ['name', 'comment', 'position', 'rate', 'image'];
}
