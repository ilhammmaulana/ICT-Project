<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $course_category = $request->input('categoryId', '');
        $courses = Course::query();

        if ($search) {
            $courses = $courses->where('name', 'like', '%' . $search . '%');
        }

        if ($course_category) {
            $courses = $courses->where('course_category_id', $course_category);
        }

        $courses = $courses->with('courseCategory')->get();
        $course_categories = CourseCategory::all();

        return view('pages.user.courses.index', [
            'courses' => $courses,
            'course_categories' => $course_categories,
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
    public function show(Course $course)
    {
        $searchModule = request()->input('searchModule', '');
        $course = Course::with([
            'modules' => function ($query) use ($searchModule) {
                $query->where('title', 'like', '%' . $searchModule . '%');
            }
        ])->where('id', $course->id)->first();

        return view('pages.user.courses.show', [
            'course' => $course,
            'course_categories' => CourseCategory::all(),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseUser $courseUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseUser $courseUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseUser $courseUser)
    {
        //
    }
}
