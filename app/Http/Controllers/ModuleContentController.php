<?php

namespace App\Http\Controllers;

use App\Models\ModuleContent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

            Log::info($request->all());
            $validated = $request->validate([
                'module_id' => 'required|exists:modules,id',
                'files' => 'nullable|file',
                'links' => 'nullable|string',
            ]);


            if ($request->hasFile('files')) {
                $files = is_array($request->file('files')) ? $request->file('files') : [$request->file('files')];

                foreach ($files as $file) {
                    $imageName = $request->input('module_id') . Carbon::now()->timestamp . '.' . $file->getClientOriginalExtension();
                    $path = $file->store('/modules/' . $imageName, 'public');
                    $filePath = str_replace('/storage', 'storage', Storage::url($path));

                    ModuleContent::create([
                        'module_id' => $validated['module_id'],
                        'content_type' => 'FILE',
                        'content' => $filePath
                    ]);
                }


            }


            if (!empty($validated['links'])) {
                // Split the string by newline characters into an array
                $linksArray = explode("\n", $validated['links']);

                // Trim each link to remove any extra whitespace
                $linksArray = array_map('trim', $linksArray);

                // Remove any empty entries, if needed
                $linksArray = array_filter($linksArray);

                foreach ($linksArray as $link) {
                    ModuleContent::create([
                        'module_id' => $validated['module_id'],
                        'content_type' => 'LINK',
                        'content' => $link

                    ]);
                }
            }



            return redirect()->route('admin.course-modules.edit', ['id' => $validated['module_id']]);
        } catch (\Throwable $th) {
            Log::info($th);
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
