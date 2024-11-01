<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['id', 'name', 'slug'];
    public function articles()
    {
        return $this->hasMany(Article::class, 'category_article_id');
    }
}
