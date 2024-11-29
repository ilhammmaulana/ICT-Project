<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
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

        return view('pages.guest.courses.index', [
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
    public function show(string $slug)
    {
        try {
            $course = Course::where('slug', $slug)->firstOrFail();
            $user = auth()->user();
            $is_user_joined = $user ? CourseUser::where('course_id', $course->id)->where('user_id', $user->id)->exists() : false;

            return view('pages.guest.courses.show', [
                'course' => $course,
                'is_user_joined' => $is_user_joined
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function join(string $id)
    {

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $course = Course::where('id', $id)->firstOrFail();
        CourseUser::create([
            'course_id' => $id,
            'user_id' => $user->id
        ]);

        Log::info("JOIN");
        return redirect()->route('user.courses.show', $course)->with('success', 'Successfully joined the course');
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
