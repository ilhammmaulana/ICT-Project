<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        // SORT COURSES BY POPULARITY
        $courses = DB::table('courses')
            ->select('courses.*', DB::raw('COUNT(course_users.id) as users_count'))
            ->leftJoin('course_users', 'courses.id', '=', 'course_users.course_id')
            ->groupBy('courses.id')
            ->orderBy('users_count', 'desc')
            ->take(3)
            ->get();
        $articles = DB::table('articles')
            ->join('users', 'articles.created_by', '=', 'users.id')
            ->select('articles.*', 'users.name as author_name') // Add 'author_name' here
            ->orderBy('articles.created_at', 'desc')
            ->take(9)
            ->get();


        return view('pages.guest.home.index', [
            'courses' => $courses,
            'articles' => $articles
        ]);

    }

    public function about()
    {
        return view('pages.guest.about.index');
    }

    public function contact()
    {
        return view('pages.guest.contact.index');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
