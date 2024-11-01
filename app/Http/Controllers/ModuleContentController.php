<?php

namespace App\Http\Controllers;

use App\Models\ModuleContent;
use Illuminate\Http\Request;

class ModuleContentController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'title' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'description' => 'nullable|string',
                'module_id' => 'required|exists:modules,id',
                'content' => 'required|string',
                'content_type' => 'required|string',
            ]);

           
            // return redirect()->route('course-categories.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ModuleContent $moduleContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModuleContent $moduleContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModuleContent $moduleContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModuleContent $moduleContent)
    {
        //
    }
}
