<?php

namespace App\Models\Blog;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    public $table = 'blog_categories';

    protected $fillable = ['name', 'description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function articles ()
    {
        return $this->hasMany(Article::class, 'category_article_id', 'id');
    }
}
