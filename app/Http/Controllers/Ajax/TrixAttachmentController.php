<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Te7aHoudini\LaravelTrix\Models\TrixAttachment;

class TrixAttachmentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file',
            'modelClass' => 'required',
            'field' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Set the path to public/articles/images/attachments/
        $path = 'articles/images/attachments/';

        // Store the file under the new path in the public disk
        $attachment = $request->file->store($path, $request->disk ?? 'public');

        // Generate the URL of the uploaded file
        $url = Storage::disk($request->disk ?? 'public')->url($attachment);

        // Save attachment details in the database
        TrixAttachment::create([
            'field' => $request->field,
            'attachable_type' => $request->modelClass,
            'attachment' => $attachment,
            'disk' => $request->disk ?? 'public',
        ]);

        return response()->json(['url' => $url], Response::HTTP_CREATED);
    }

    public function destroy($url)
    {
        $attachment = TrixAttachment::where('attachment', basename($url))->first();

        return response()->json(optional($attachment)->purge());
    }
}
