<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $courses = Course::with('courseCategory')->where('name', 'like', '%' . $search . '%')->get();
        return view('pages.admin.courses.index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course_categories = CourseCategory::all();

        return view('pages.admin.courses.create', [
            'course_categories' => $course_categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image:max:4096:mimes:png,jpg,jpeg',
                'course_category_id' => 'required|exists:course_categories,id',
            ]);

            $slug = Str::slug($validate['name']);

            $same_slug_count = Course::where('slug', $slug)->count();

            if ($same_slug_count > 0) {
                $slug = $slug . '-' . $same_slug_count;
            }


            if (isset($validate['image']) && $request->hasFile('image')) {
                $image_name = $slug . Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->store('/courses/' . $image_name, 'public');
                $imagePath = str_replace('/storage', 'storage', Storage::url($path));
                $validate['image'] = $imagePath;
            }


            if (!isset($validate['meta_title'])) {
                $validate['meta_title'] = $validate['title'];
            }

            if (!isset($validate['meta_description'])) {
                $validate['meta_description'] = $validate['description'];
            }

            Course::create([
                'name' => $validate['name'],
                'slug' => $slug,
                'meta_title' => $validate['meta_title'],
                'meta_description' => $validate['meta_description'],
                'title' => $validate['title'],
                'description' => $validate['description'],
                'image' => isset($validate['image']) ? $validate['image'] : null,
                'course_category_id' => $validate['course_category_id'],
                'created_by' => auth()->user()->id
            ]);

            return redirect()->route('admin.courses.index');
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('pages.admin.courses.show', [
            'course' => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Course $course)
    {
        $searchModule = $request->input('searchModule', '');
        $course = Course::with(['modules' => function ($query) use ($searchModule) {
            $query->where('title', 'like', '%' . $searchModule . '%');
        }])->where('id', $course->id)->first();

        return view('pages.admin.courses.edit', [
            'course' => $course,
            'course_categories' => CourseCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        try {
            $validate = $request->validate([
                'name' => 'required|string',
                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image:max:4096:mimes:png,jpg,jpeg',
                'course_category_id' => 'required|exists:course_categories,id',
            ]);
            
            $slug = Str::slug($validate['name']);

            $same_slug_count = Course::where('slug', $slug)->count();

            if ($same_slug_count > 0) {
                $slug = $slug . '-' . $same_slug_count;
            }

            if ($request->hasFile('image')) {
                $image_name = $slug . Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->store('/courses/' . $image_name, 'public');
                $imagePath = str_replace('/storage', 'storage', Storage::url($path));
                $validate['image'] = $imagePath;


                // delete olg image
                Storage::delete($course->image);
            }


            $course->update([
                'name' => $validate['name'],
                'slug' => $slug,
                'meta_title' => $validate['meta_title'],
                'meta_description' => $validate['meta_description'],
                'title' => $validate['title'],
                'description' => $validate['description'],
                'image' => $validate['image'],
                'course_category_id' => $validate['course_category_id'],
                'created_by' => auth()->user()->id
            ]);

            return redirect()->route('admin.courses.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Course::where('id', $id)->delete();
        return redirect()->route('admin.courses.index');
    }
}
