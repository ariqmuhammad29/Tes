<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UploadImage;

class Product_image extends Model
{
    use UploadImage;
    protected $fillable = ['product_id', 'image'];

    public function portofolio()
    {
        return $this->hasOne(PostProduct::class);
    }
}
