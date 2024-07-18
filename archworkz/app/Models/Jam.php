<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    public $table = 'jams';

    protected $fillable = ['title'];

    public function tamu()
    {
        return $this->hasMany(Tamu::class, 'jam', 'id');
    }

}
