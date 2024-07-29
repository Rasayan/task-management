<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'due_date' => 'nullable|date',
        'user_id' => 'required|exists:users,id'
    ]);

    $validatedData['status'] = 'pending'; // Set default status

    $task = Task::create($validatedData);

    return response()->json($task, 201);
}

public function updateStatus(Request $request, Task $task)
{
    $validatedData = $request->validate([
        'status' => 'required|in:pending,in_progress,completed',
    ]);

    $task->update($validatedData);

    return response()->json($task);
}

    public function getPendingTasks()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $pendingTasks = Task::where('status', 'pending')
                            ->where('user_id', Auth::id()) // Filter tasks by the authenticated user
                            ->get();
        return response()->json($pendingTasks);
    }

    public function getProgressTasks()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'in_progress'], 401);
        }

        $pendingTasks = Task::where('status', 'pending')
                            ->where('user_id', Auth::id()) // Filter tasks by the authenticated user
                            ->get();
        return response()->json($pendingTasks);
    }

    public function getCompletedTasks()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $pendingTasks = Task::where('status', 'completed')
                            ->where('user_id', Auth::id()) // Filter tasks by the authenticated user
                            ->get();
        return response()->json($pendingTasks);
    }
}
