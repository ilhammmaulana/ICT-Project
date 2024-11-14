<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
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
            ]);

            Module::create([

                'course_id' => $validate['course_id'],
                'title' => $validate['title'],
                'description' => $validate['description'],
            ]);

            return redirect()->route('admin.courses.edit', ['course' => $validate['course_id']]);
            
        } catch (\Throwable $th) {
            Log::error($th);
            //throw $th;
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
        return redirect()->route('admin.courses.edit', ['course' => $module->course_id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'description' => 'nullable|string',
            ]);

            $module->update($validate);
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
    }
}
