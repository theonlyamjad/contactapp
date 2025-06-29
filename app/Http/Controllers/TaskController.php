<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Business;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show tasks with optional contact search
    public function index(Request $request)
    {
        $user = Auth::user();
        $contactQuery = $request->input('contact_search');

        // Fetch only tasks belonging to the logged-in user
        $tasksQuery = Task::where('user_id', $user->id)->where('status', 'open');

        if ($contactQuery) {
            $tasksQuery->where(function ($query) use ($contactQuery) {
                $query->whereHasMorph('taskable', [Person::class], function ($subQuery) use ($contactQuery) {
                    $subQuery->where('firstname', 'like', "%{$contactQuery}%")
                             ->orWhere('lastname', 'like', "%{$contactQuery}%");
                })
                ->orWhereHasMorph('taskable', [Business::class], function ($subQuery) use ($contactQuery) {
                    $subQuery->where('business_name', 'like', "%{$contactQuery}%");
                });
            });
        }

        $tasks = $tasksQuery->paginate(20);
        return view('task.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'taskable_id'  => 'required|integer',
            'target_model' => 'required|in:business,person'
        ]);

        // Determine the model type
        $targetModel = match ($validated['target_model']) {
            'business' => Business::where('id', $validated['taskable_id'])->where('user_id', Auth::id())->first(),
            'person'   => Person::where('id', $validated['taskable_id'])->where('user_id', Auth::id())->first(),
        };

        if (!$targetModel) {
            abort(403, 'Unauthorized action.');
        }

        // Create the task and assign the logged-in user
        $targetModel->tasks()->create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'user_id'     => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    // Mark a task as completed
    public function complete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->markAsCompleted();
        return redirect()->back()->with('success', 'Task marked as completed.');
    }
}
