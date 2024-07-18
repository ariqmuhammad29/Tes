<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\User;

class Tamu extends Model
{
    use Sluggable;
    public $table = 'tamus';

    protected $fillable = [
        'title',
        'jam',
        'konfirmasi',
        'jumlah',
        'datang',
        'jumlah_datang',
        'user_id',
        'phone'
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

    public function jams()
    {
        return $this->hasOne(Jam::class, 'id', 'jam');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
