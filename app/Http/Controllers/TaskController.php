<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 🔹 1. Show all tasks with filters (Admin only gets everything)
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Task::with('user');

        if (!$user->isAdmin()) {
            if ($user->isPM()) {
                $query->where('pm_id', $user->id); // optional if you track PMs
            } elseif ($user->isUser()) {
                $query->where('user_id', $user->id);
            } elseif ($user->isViewer()) {
                $query->where('is_public', true);
            } else {
                abort(403, 'Unauthorized');
            }
        }

        // Filters for all roles that can see tasks
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->priority) {
            $query->where('priority', $request->priority);
        }

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $tasks = $query->get();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'users'));
    }

    // 🔹 2. Show create form
    public function create()
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isUser()) {
            $users = User::all();
            return view('tasks.create', compact('users'));
        }

        abort(403, 'Unauthorized');
    }

   // 🔹 3. Store a new task
public function store(Request $request)
{
    $user = Auth::user();

    if (!($user->isAdmin() || $user->isUser())) {
        abort(403, 'Unauthorized');
    }

    // Validate input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,in_progress,completed',
        'priority' => 'required|in:low,medium,high',
        'user_id' => 'required|exists:users,id',
        'deadline' => 'nullable|date',
    ]);

    // ✅ Only override user_id if current user is NOT an admin
    $taskData = $request->all();
    if (!$user->isAdmin()) {
        $taskData['user_id'] = $user->id; // Force assignment to self
    }

    Task::create($taskData);

    return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
}


    // 🔹 4. Show edit form
    public function edit(Task $task)
    {
        $user = Auth::user();

        if ($user->isAdmin() || ($user->isUser() && $task->user_id === $user->id)) {
            $users = User::all();
            return view('tasks.edit', compact('task', 'users'));
        }

        if ($user->isPM() && $task->pm_id === $user->id) {
            return view('tasks.edit-status', compact('task'));
        }

        abort(403, 'Unauthorized');
    }

    // 🔹 5. Update a task
    public function update(Request $request, Task $task)
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|in:pending,in_progress,completed',
                'priority' => 'required|in:low,medium,high',
                'user_id' => 'required|exists:users,id',
                'deadline' => 'nullable|date',
            ]);
            $task->update($request->all());
            return redirect()->route('tasks.index')->with('success', 'Task updated.');
        }

        if ($user->isUser() && $task->user_id === $user->id) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'priority' => 'required|in:low,medium,high',
            ]);
            $task->update($request->only('title', 'description', 'priority'));
            return redirect()->route('tasks.index')->with('success', 'Task updated.');
        }

        if ($user->isPM() && $task->pm_id === $user->id) {
            $request->validate([
                'status' => 'required|in:pending,in_progress,completed',
            ]);
            $task->update($request->only('status'));
            return redirect()->route('tasks.index')->with('success', 'Task status updated.');
        }

        abort(403, 'Unauthorized');
    }

    // 🔹 6. Delete a task
    public function destroy(Task $task)
    {
        $user = Auth::user();

        if ($user->isAdmin() || ($user->isUser() && $task->user_id === $user->id)) {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted.');
        }

        abort(403, 'Unauthorized');
    }

    // 🔹 7. Show single task
    public function show(Task $task)
    {
        $user = Auth::user();

        if ($user->isAdmin() ||
            ($user->isUser() && $task->user_id === $user->id) ||
            ($user->isPM() && $task->pm_id === $user->id) ||
            ($user->isViewer() && $task->is_public)) {
            return view('tasks.show', compact('task'));
        }

        abort(403, 'Unauthorized');
    }
}
