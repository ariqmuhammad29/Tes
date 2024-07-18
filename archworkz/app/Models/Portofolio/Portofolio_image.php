<?php

namespace App\Models\Portofolio;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UploadImage;

class Portofolio_image extends Model
{
    use UploadImage;
    protected $fillable = ['portfolio_id', 'image'];

    public function portofolio()
    {
        return $this->hasOne(Portofolio::class);
    }
}
