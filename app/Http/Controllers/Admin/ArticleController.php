<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Framework\MockObject\Generator\DuplicateMethodException;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('pages.admin.articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $articleCategories = ArticleCategory::orderBy('name', 'asc')->get();
        return view('pages.admin.articles.create', [
            'articleCategories' => $articleCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable',
            'article_category_id' => 'required|exists:article_categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_author' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        try {
            // Check if the slug already exists in the database
            $slug = Str::slug($validatedData['title']);
            $existingArticle = Article::where('slug', $slug)->first();

            if ($existingArticle) {
                return back()->withErrors(['error' => 'An article with this slug already exists. Please choose a different title.']);
            }

            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('image')) {
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('articles/images', 'public');
                    $imagePath = str_replace('public/', '', $imagePath);
                }
            }

            // Handle Trix editor file attachments (if there are any files uploaded through Trix)
            $attachments = $request->input('attachment-article-trixFields');
            if ($attachments && count($attachments) > 0) {
                $attachments = implode(',', $attachments);  // Store as comma-separated string or JSON
            }

            // Sanitize content to remove any script tags and prevent XSS
            $content = strip_tags($request->input('article-trixFields')['content'], '<div><p><a><ul><ol><li><strong><em><u><b><i><br><img><h1><h2><h3><h4><h5><h6><blockquote><code>');  // Keep allowed HTML tags

            // Store the article data
            $article = Article::create([
                'title' => $validatedData['title'],
                'content' => $content,  // Store sanitized content from Trix editor
                'slug' => $slug,  // Ensure slug is unique
                'created_by' => Auth::user()->id,
                'article_category_id' => $validatedData['article_category_id'],
                'meta_title' => $validatedData['meta_title'] ?? null,
                'meta_author' => $validatedData['meta_author'] ?? null,
                'meta_keyword' => $validatedData['meta_keyword'] ?? null,
                'meta_description' => $validatedData['meta_description'] ?? null,
                'image' => $imagePath ?? null,  // Store image path if uploaded
                'attachments' => $attachments ?? null,  // Store attachments if present
                'post-trixFields' => request('post-trixFields'),
                'attachment-post-trixFields' => request('attachment-post-trixFields')
            ]);


            // Return success message after creating the article
            return redirect()->route('admin.articles.index')
                ->with('success', 'Article created successfully.');
        } catch (\Exception $e) {
            // Handle any errors that may occur
            return back()->withErrors(['error' => 'There was an error saving the article: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::with(['categoryArticle'])->find($id);
        $articleCategories = ArticleCategory::orderBy('name', 'asc')->get();
        return view('pages.admin.articles.edit', compact('article', 'articleCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'nullable',
                'article_category_id' => 'required|exists:article_categories,id',
                'meta_title' => 'nullable|string|max:255',
                'meta_author' => 'nullable|string|max:255',
                'meta_keyword' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:500',
                'image' => 'image|mimes:jpg,jpeg,png',
            ]);
            $slug = Str::slug($validatedData['title']);
            $existingArticle = Article::where('slug', $slug)->first();
            $article = Article::select('image')->where('id', $id)->first();
            if ($existingArticle  && $slug !== $existingArticle->slug) {
                // Return an error if the slug already exists
                return back()->with('error', 'An article with this slug already exists. Please choose a different title.');
            }
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Store the file in the 'articles/images' folder
                $imagePath = $request->file('image')->store('articles/images', 'public');
                $imagePath = str_replace('public/', '', $imagePath);
            } else {
                $imagePath = $article->image;
            }

            $content = strip_tags($request->input('article-trixFields')['content'], '<div><p><a><ul><ol><li><strong><em><u><b><i><br><img><h1><h2><h3><h4><h5><h6><blockquote><code>');  // Keep allowed HTML tags
            // Handle image upload if present
            Article::where('id', $id)->update([
                'title' => $validatedData['title'],
                'content' => $content,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'article_category_id' => $validatedData['article_category_id'],
                'meta_title' => $validatedData['meta_title'] ?? null,
                'meta_author' => $validatedData['meta_author'] ?? null,
                'meta_keyword' => $validatedData['meta_keyword'] ?? null,
                'meta_description' => $validatedData['meta_description'] ?? null,
                'image' => $imagePath ?? null,
                ]);
            return redirect()->route('admin.articles.index')->with('success', 'Success update article!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        Storage::delete($article->image);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Success delete artile!');
    }
}
