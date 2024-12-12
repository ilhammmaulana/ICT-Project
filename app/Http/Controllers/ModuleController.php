<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\ModuleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            Log::info($request->all());
            $validate = $request->validate([
                'title' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'description' => 'nullable|string',
                'module_content_links' => 'nullable|array',
            ]);

            $module = Module::create([
                'course_id' => $validate['course_id'],
                'title' => $validate['title'],
                'description' => $validate['description'],
            ]);

            if (isset($validate['module_content_links'])) {
                foreach ($validate['module_content_links'] as $module_content_link) {
                    $module_content = new ModuleContent();
                    $module_content->content_type = 'LINK';
                    $module_content->module_id = $module->id;
                    $module_content->content = $module_content_link;
                    $module_content->save();
                }
            }

            // Pass success message to the next request
            return redirect()->route('admin.courses.show', ['course' => $validate['course_id']])
                ->with('success', 'Module added successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
            // Pass error message to the next request
            return redirect()->route('admin.courses.show', ['course' => $validate['course_id']])
                ->with('error', 'Something went wrong, please try again.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $module = Module::find($id)->first();
        return view('pages.admin.course-modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        try {
            Log::info($request->all());
            $validate = $request->validate([
                'title' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'description' => 'nullable|string',
                'module_content_links' => 'nullable|array',
            ]);

            $module->update($validate);

            DB::beginTransaction();
            ModuleContent::where('module_id', $module->id)->delete();

            if (isset($validate['module_content_links'])) {
                foreach ($validate['module_content_links'] as $module_content_link) {
                    $module_content = new ModuleContent();
                    $module_content->content_type = 'LINK';
                    $module_content->module_id = $module->id;
                    $module_content->content = $module_content_link;
                    $module_content->save();
                }
            }
            DB::commit();

            return redirect()->route('admin.courses.show', ['course' => $validate['course_id']])
                ->with('success', 'Module updated successfully!');

        } catch (\Throwable $th) {
            return redirect()->route('admin.courses.show', ['course' => $validate['course_id']])
                ->with('error', 'Something went wrong, please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        try {
            $course = Course::where('id', $module->course_id)->first();
            ModuleContent::where('module_id', $module->id)->delete();
            $module->delete();
            return redirect()->route('admin.courses.show', ['course' => $course]);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }
}
