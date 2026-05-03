<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Payment;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->fresh();
        
        $projectsCount = \App\Models\Project::count();
        
        $tasksCompleted = Task::where('assigned_to', $user->id)
            ->where('status', 'completed')
            ->count();
            
        $completedTasks = Task::where('assigned_to', $user->id)->count();
        $efficiency = $completedTasks > 0 ? round(($tasksCompleted / $completedTasks) * 100) : 0;
        
        $balance = \App\Models\Payment::where('status', 'completed')->sum('amount') ?? 0;
        
        $stats = [
            'projects' => $projectsCount,
            'projects_growth' => 0,
            'tasks_completed' => $tasksCompleted,
            'efficiency' => $efficiency,
            'balance' => $balance,
            'balance_growth' => 0,
        ];
        
        $completion = 0;
        if ($user->name) $completion += 25;
        if ($user->email) $completion += 25;
        if ($user->profile && $user->profile->phone) $completion += 25;
        if ($user->profile && $user->profile->bio) $completion += 25;
        
        return view('profile', compact('stats', 'completion'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $updateData = [
            'email' => $request->email,
        ];
        
        $firstName = $request->input('first_name', '');
        $lastName = $request->input('last_name', '');
        if (!empty($firstName) || !empty($lastName)) {
            $updateData['name'] = trim($firstName . ' ' . $lastName);
        }

        $user->update($updateData);

        $profileData = [
            'phone' => $request->phone,
            'bio' => $request->bio,
            'title' => $request->title,
            'company' => $request->company,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'payment_method' => $request->payment_method,
        ];
        
        if ($user->profile) {
            $user->profile->update($profileData);
        } else {
            $user->profile()->create($profileData);
        }

        return back()->with('success', 'Profile updated successfully');
    }

    public function password(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}