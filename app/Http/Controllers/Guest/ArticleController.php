<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $article_category = $request->input('categoryId', '');
        $article_categories = ArticleCategory::orderBy('name', 'asc')->get();
        $articles = Article::query();

        if ($article_category) {
            $articles = $articles->where('article_category_id', $article_category);
        }

        $articles = $articles->with(['categoryArticle'])->latest()->paginate(9);

        return view('pages.guest.articles.index', compact('articles', 'article_categories'));
    }
    public function show($slug)
    {
        $article = Article::with(['categoryArticle', 'user'])->where('slug', $slug)->first();
        return view('pages.guest.articles.show', compact('article'));
    }
}
