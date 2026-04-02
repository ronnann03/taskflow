<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $tasks = Task::with('employee')->get();
        } else {
            $tasks = Task::with('employee')
                ->where('employee_id', $user->employee_id)
                ->get();
        }

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'in:pendiente,en_progreso,completada',
            'due_date'    => 'nullable|date',
        ]);

        $task = Task::create($data);
        return response()->json($task, 201);
    }

    public function show(Request $request, Task $task)
    {
        $user = $request->user();

        if (! $user->isAdmin() && $task->employee_id !== $user->employee_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        return response()->json($task->load('employee'));
    }

    public function update(Request $request, Task $task)
    {
        $user = $request->user();

        if (! $user->isAdmin() && $task->employee_id !== $user->employee_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $data = $request->validate([
            'employee_id' => 'sometimes|exists:employees,id',
            'title'       => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'sometimes|in:pendiente,en_progreso,completada',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($data);
        return response()->json($task);
    }

    public function destroy(Request $request, Task $task)
    {
        $user = $request->user();

        if (! $user->isAdmin() && $task->employee_id !== $user->employee_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
