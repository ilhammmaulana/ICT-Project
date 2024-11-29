<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['categoryArticle'])->latest()->paginate(9); // Paginate 9 artikel per halaman
        return view('pages.guest.articles.index', compact('articles'));
    }
    public function show($slug)
    {
        $article = Article::with(['categoryArticle', 'user'])->where('slug', $slug)->first();
        return view('pages.guest.articles.show', compact('article'));
    }
}
