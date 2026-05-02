<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $query = Note::query();

        if ($request->has('related_type') && $request->has('related_id')) {
            $query->where('related_type', $request->related_type)
                  ->where('related_id', $request->related_id);
        }

        $notes = $query->orderBy('created_at', 'desc')->paginate(20);
        return $this->success($notes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'related_type' => 'nullable|string',
            'related_id' => 'nullable|integer',
        ]);

        $note = Note::create([
            'content' => $request->content,
            'related_type' => $request->related_type,
            'related_id' => $request->related_id,
            'created_by' => $request->user()->id,
        ]);

        return $this->success($note, 'Note created successfully', 201);
    }

    public function show(Note $note)
    {
        return $this->success($note);
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $note->update(['content' => $request->content]);

        return $this->success($note, 'Note updated successfully');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return $this->success(null, 'Note deleted successfully');
    }
}