<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::with('employee')->get());
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

    public function show(Task $task)
    {
        return response()->json($task->load('employee'));
    }

    public function update(Request $request, Task $task)
    {
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

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
