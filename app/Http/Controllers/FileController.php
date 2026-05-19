<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientDocument;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
public function index(Request $request)
    {
        // Get files from both files table and client_documents
        $files = File::with(['uploader'])
            ->latest()
            ->limit(20)
            ->get();
        
        // Also get client documents with their files
        $clientDocs = ClientDocument::with(['file', 'client', 'uploader'])
            ->latest()
            ->limit(20)
            ->get();

        // Merge both collections
        $allFiles = $files->concat($clientDocs->map(function($doc) {
            if ($doc->file) {
                $doc->file->name = $doc->title ?? $doc->file->name;
                $doc->file->client = $doc->client;
                return $doc->file;
            }
            return null;
        })->filter())->values();

        $totalFiles = $allFiles->count();
        $totalSize = $allFiles->sum('size') ?? 0;
        $thisMonth = File::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $stats = [
            'total_files' => $totalFiles,
            'total_size' => $totalSize,
            'this_month' => $thisMonth,
        ];

        return view('files.index', compact('files', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar,csv,svg,webp',
            'name' => 'nullable|string|max:255',
            'client_id' => 'nullable|exists:clients,id',
        ]);

        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('uploads/' . date('Y/m'), 'public');

        $file = File::create([
            'name' => $request->name ?? $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'size' => $uploadedFile->getSize(),
            'mime_type' => $uploadedFile->getMimeType(),
            'uploaded_by' => auth()->id(),
            'client_id' => $request->client_id,
        ]);

        return redirect()->route('files')->with('success', 'File uploaded successfully');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        
        return Storage::disk('public')->download($file->path, $file->name);
    }

    public function destroy($id)
    {
        $file = File::findOrFail($id);
        
        Storage::disk('public')->delete($file->path);
        $file->delete();

        return back()->with('success', 'File deleted');
    }

    public function shareFile(Request $request, $id)
    {
        $file = File::findOrFail($id);

        $validated = $request->validate([
            'expiration' => 'nullable|in:never,1h,1d,7d,30d',
            'password' => 'nullable|string|min:4|max:20',
            'views_limit' => 'nullable|in:unlimited,1,5,10',
            'access' => 'nullable|in:view,download',
        ]);

        $options = [
            'expiration' => $validated['expiration'] ?? 'never',
            'password' => $validated['password'] ?? null,
            'views_limit' => $validated['views_limit'] ?? 'unlimited',
            'access' => $validated['access'] ?? 'view',
        ];

        $shareUrl = $file->generateShareLink($options);

        return response()->json([
            'success' => true,
            'share_url' => $shareUrl,
            'message' => 'Share link generated successfully'
        ]);
    }

    public function disableShare($id)
    {
        $file = File::findOrFail($id);
        $file->disableShare();

        return back()->with('success', 'Share link disabled');
    }

    public function viewShared($hash)
    {
        $file = File::where('share_hash', $hash)->firstOrFail();
        
        return view('files.share', compact('file'));
    }

    public function verifyPassword(Request $request, $hash)
    {
        $file = File::where('share_hash', $hash)->firstOrFail();
        
        $validation = $file->validateShareAccess($request->password);
        
        if (!$validation['valid']) {
            if (isset($validation['requires_password'])) {
                return response()->json([
                    'success' => false,
                    'error' => $validation['error'],
                    'requires_password' => true
                ], 401);
            }
            return response()->json([
                'success' => false,
                'error' => $validation['error']
            ], 403);
        }
        
        $file->recordShareView();
        
        return response()->json([
            'success' => true,
            'valid' => true,
            'can_download' => $file->share_access === 'download'
        ]);
    }

    public function downloadShared($hash)
    {
        $file = File::where('share_hash', $hash)->firstOrFail();
        
        $validation = $file->validateShareAccess(request('password'));
        
        if (!$validation['valid']) {
            if (isset($validation['requires_password'])) {
                return redirect()->route('files.share.view', $hash)
                    ->with('error', 'Password required')
                    ->with('requires_password', true);
            }
            abort(403, $validation['error']);
        }
        
        if ($file->share_access !== 'download') {
            abort(403, 'Download not allowed for this share link');
        }
        
        $file->recordShareView();
        
        return Storage::disk('public')->download($file->path, $file->name);
    }
}