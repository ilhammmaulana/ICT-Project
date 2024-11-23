<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search', '');

        $course_categories = CourseCategory::where('name', 'like', '%' . $search . '%')->get();
        return view('pages.admin.course-categories.index', compact('course_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string',
            ]);

            CourseCategory::create([
                'name' => $validate['name'],
            ]);
            return redirect()->route('admin.course-categories.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseCategory $courseCategory)
    {
        $course_category = CourseCategory::findOrFail($courseCategory->id);

        return view('pages.admin.course-categories.show', [
            'course_category' => $course_category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCategory $courseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseCategory $courseCategory)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string',
            ]);

            $courseCategory->update([
                'name' => $validate['name'],
            ]);

            $courseCategory->fresh();
            return redirect()->route('admin.course-categories.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategory $courseCategory)
    {
        $courseCategory->delete();
        return redirect()->route('admin.course-categories.index');
    }
}
