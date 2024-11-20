<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = ['id', 'title', 'slug', 'meta_description', 'article_category_id', 'meta_title', 'body', 'image', 'meta_author', 'meta_keyword'];
    public function categoryArticle()   
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
