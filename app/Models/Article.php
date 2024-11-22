<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Article extends Model
{
    use HasFactory, HasUuids, HasTrixRichText;
    protected $fillable = ['id', 'content', 'created_by', 'title', 'slug', 'meta_description', 'article_category_id', 'meta_title', 'body', 'image', 'meta_author', 'meta_keyword'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoryArticle()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
