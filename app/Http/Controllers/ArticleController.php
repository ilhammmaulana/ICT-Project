<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search', '');
        $categoryId = request()->input('categoryId', '');

        $article_categories = ArticleCategory::all();
        $articles = Article::query();

        if ($search) {
            $articles = $articles->where('title', 'like', '%' . $search . '%');
        }

        if ($categoryId) {
            $articles = $articles->where('article_category_id', $categoryId);
        }

        $articles = $articles->get();

        return view('pages.user.articles.index', [
            'articles' => $articles,
            'article_categories' => $article_categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('pages.user.articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
