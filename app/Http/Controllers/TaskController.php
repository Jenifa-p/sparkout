<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskController extends Controller
{
    public function create(Project $project)
    {
        $users = User::all();
        return view('tasks.create', compact('project', 'users'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projectview', $project)->with('success', 'Task created successfully.');
    }

    public function edit(Project $project,Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('project', 'task', 'users'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $task->update($request->all());

        return redirect()->route('projectview', $project)->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projectview', $project)->with('success', 'Task deleted successfully.');
    }


    public function markAsCompleted(Project $project, Task $task)
    {
        $task->update(['is_completed' => true]);

        return redirect()->route('projectview', $project)->with('success', 'Task marked as completed.');
    }


}
