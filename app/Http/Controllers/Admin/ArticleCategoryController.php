<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search');

        $articleCategories = ArticleCategory::where('name', 'like', '%' . $search . '%')->latest()->paginate(10);
        return view('pages.admin.articles-categories.index', compact('articleCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.articles-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:article_categories,name',
            ]);
            $validatedData['slug'] = Str::slug($validatedData['name']);
            ArticleCategory::create($validatedData);
            return redirect()->route('admin.article-categories.index')->with('success', 'Succcessfully created article category');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $articleCategory = ArticleCategory::find($id);
        return view('pages.admin.articles-categories.edit', [
            'articleCategory' => $articleCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Validasi data dari request
            $articleCategory = ArticleCategory::findOrFail($id);
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('article_categories', 'name')->ignore($articleCategory->id), // Abaikan unique untuk ID saat ini
                ],
            ]);

            // Update data slug berdasarkan nama baru
            $validatedData['slug'] = Str::slug($validatedData['name']);

            // Perbarui data kategori artikel
            $articleCategory->update($validatedData);

            // Redirect kembali dengan pesan sukses
            return redirect()->route('admin.article-categories.index')->with('success', 'Successfully updated article category');
        } catch (\Throwable $th) {
            // Tangkap error untuk debugging atau logging
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ArticleCategory::destroy($id);
        return redirect()->route('admin.article-categories.index')->with('success', 'Success delete category article!');
    }
}
