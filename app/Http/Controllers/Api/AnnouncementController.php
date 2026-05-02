<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->paginate(15);
        return $this->success($announcements);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => $request->user()->id,
        ]);

        return $this->success($announcement, 'Announcement created successfully', 201);
    }

    public function show(Announcement $announcement)
    {
        return $this->success($announcement->load('creator:id,name'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $announcement->update($request->only(['title', 'content']));

        return $this->success($announcement, 'Announcement updated successfully');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return $this->success(null, 'Announcement deleted successfully');
    }
}