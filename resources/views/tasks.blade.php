@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-600">Tareas</h1>

    {{-- Formulario --}}
    <div class="mb-6 grid grid-cols-2 gap-3">
        <select id="employee_id" class="border rounded px-3 py-2">
            <option value="">Seleccionar Empleado</option>
        </select>
        <input id="title" type="text" placeholder="Título" class="border rounded px-3 py-2">
        <textarea id="description" placeholder="Descripción" class="border rounded px-3 py-2 col-span-2"></textarea>
        <select id="status" class="border rounded px-3 py-2">
            <option value="pendiente">Pendiente</option>
            <option value="en_progreso">En Progreso</option>
            <option value="completada">Completada</option>
        </select>
        <input id="due_date" type="date" class="border rounded px-3 py-2">
        <button onclick="createTask()" class="col-span-2 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Agregar Tarea
        </button>
    </div>

    {{-- Lista --}}
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Título</th>
                <th class="p-3 border">Empleado</th>
                <th class="p-3 border">Status</th>
                <th class="p-3 border">Fecha</th>
                <th class="p-3 border">Acciones</th>
            </tr>
        </thead>
        <tbody id="tasks-list"></tbody>
    </table>
</div>

<script>
const api = 'http://127.0.0.1:8000/api/v1';

async function loadEmployeeOptions() {
    const res = await axios.get(`${api}/employees`);
    const select = document.getElementById('employee_id');
    res.data.forEach(emp => {
        select.innerHTML += `<option value="${emp.id}">${emp.name}</option>`;
    });
}

async function loadTasks() {
    const res = await axios.get(`${api}/tasks`);
    const tbody = document.getElementById('tasks-list');
    tbody.innerHTML = '';
    res.data.forEach(task => {
        const statusColor = {
            pendiente: 'bg-yellow-100 text-yellow-800',
            en_progreso: 'bg-blue-100 text-blue-800',
            completada: 'bg-green-100 text-green-800'
        }[task.status];

        tbody.innerHTML += `
            <tr class="border-b">
                <td class="p-3 border">${task.id}</td>
                <td class="p-3 border">${task.title}</td>
                <td class="p-3 border">${task.employee?.name ?? 'N/A'}</td>
                <td class="p-3 border">
                    <span class="px-2 py-1 rounded text-sm font-medium ${statusColor}">
                        ${task.status}
                    </span>
                </td>
                <td class="p-3 border">${task.due_date ?? '-'}</td>
                <td class="p-3 border">
                    <button onclick="deleteTask(${task.id})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Eliminar
                    </button>
                </td>
            </tr>`;
    });
}

async function createTask() {
    const employee_id = document.getElementById('employee_id').value;
    const title       = document.getElementById('title').value;
    const description = document.getElementById('description').value;
    const status      = document.getElementById('status').value;
    const due_date    = document.getElementById('due_date').value;

    await axios.post(`${api}/tasks`, { employee_id, title, description, status, due_date });

    document.getElementById('title').value       = '';
    document.getElementById('description').value = '';
    loadTasks();
}

async function deleteTask(id) {
    await axios.delete(`${api}/tasks/${id}`);
    loadTasks();
}

loadEmployeeOptions();
loadTasks();
</script>
@endsection