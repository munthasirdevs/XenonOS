<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileLog;
use App\Models\Tag;
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

    public function categories()
    {
        $categories = FileCategory::withCount('files')->orderBy('name')->get();
        return $this->success($categories);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:file_categories,name',
            'description' => 'nullable|string',
        ]);

        $category = FileCategory::create($request->all());
        return $this->success($category, 'Category created', 201);
    }

    public function assignCategory(Request $request, File $file)
    {
        $request->validate([
            'category_id' => 'required|exists:file_categories,id',
        ]);

        $file->update(['category_id' => $request->category_id]);
        return $this->success($file->load('category'), 'Category assigned');
    }

    public function addTag(Request $request, File $file)
    {
        $request->validate([
            'tag' => 'required|string|max:100',
        ]);

        $tag = Tag::firstOrCreate(['name' => $request->tag]);
        $file->tags()->syncWithoutDetaching([$tag->id]);

        return $this->success($file->load('tags'), 'Tag added');
    }

    public function removeTag(Request $request, File $file)
    {
        $request->validate([
            'tag_id' => 'required|exists:tags,id',
        ]);

        $file->tags()->detach($request->tag_id);
        return $this->success(null, 'Tag removed');
    }

    public function search(Request $request)
    {
        $query = File::query()->with(['uploader:id,name', 'category', 'tags']);

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag_id);
            });
        }

        $files = $query->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($files);
    }
}