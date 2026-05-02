<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileLog;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = File::query()->with('uploader:id,name');

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->has('type')) {
            $query->where('mime_type', 'like', $request->type . '%');
        }

        $files = $query->orderBy('created_at', 'desc')->paginate(20);

        return $this->success($files);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'name' => 'nullable|string|max:255',
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('files/' . date('Y/m'), 'public');

        $file = File::create([
            'name' => $request->name ?? $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'size' => $uploadedFile->getSize(),
            'mime_type' => $uploadedFile->getMimeType(),
            'uploaded_by' => $request->user()->id,
        ]);

        FileLog::create([
            'file_id' => $file->id,
            'action' => 'uploaded',
            'user_id' => $request->user()->id,
        ]);

        return $this->success($file->load('uploader'), 'File uploaded successfully', 201);
    }

    public function show(File $file)
    {
        $file->load('uploader:id,name');
        return $this->success($file);
    }

    public function destroy(Request $request, File $file)
    {
        if ($file->path && Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        FileLog::create([
            'file_id' => $file->id,
            'action' => 'deleted',
            'user_id' => $request->user()->id,
        ]);

        $file->delete();

        return $this->success(null, 'File deleted successfully');
    }

    public function download(Request $request, File $file)
    {
        FileLog::create([
            'file_id' => $file->id,
            'action' => 'downloaded',
            'user_id' => $request->user()->id,
        ]);

        return Storage::disk('public')->download($file->path, $file->name);
    }
}