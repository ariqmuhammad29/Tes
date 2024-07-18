<?php

namespace App\Models;

use App\Models\Traits\UploadImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    protected $fillable = ['title', 'description'];
}
