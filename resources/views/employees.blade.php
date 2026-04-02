@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-600">Empleados</h1>

    {{-- Formulario --}}
    <div class="mb-6 grid grid-cols-3 gap-3">
        <input id="name" type="text" placeholder="Nombre" class="border rounded px-3 py-2">
        <input id="email" type="email" placeholder="Email" class="border rounded px-3 py-2">
        <select id="role" class="border rounded px-3 py-2">
            <option value="admin">Admin</option>
            <option value="developer">Developer</option>
            <option value="designer">Designer</option>
        </select>
        <button onclick="createEmployee()" class="col-span-3 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Agregar Empleado
        </button>
    </div>

    {{-- Lista --}}
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Nombre</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Rol</th>
                <th class="p-3 border">Acciones</th>
            </tr>
        </thead>
        <tbody id="employees-list"></tbody>
    </table>
</div>

<script>
const api = 'http://127.0.0.1:8000/api/v1';

async function loadEmployees() {
    const res = await axios.get(`${api}/employees`);
    const tbody = document.getElementById('employees-list');
    tbody.innerHTML = '';
    res.data.forEach(emp => {
        tbody.innerHTML += `
            <tr class="border-b">
                <td class="p-3 border">${emp.id}</td>
                <td class="p-3 border">${emp.name}</td>
                <td class="p-3 border">${emp.email}</td>
                <td class="p-3 border">${emp.role}</td>
                <td class="p-3 border">
                    <button onclick="deleteEmployee(${emp.id})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Eliminar
                    </button>
                </td>
            </tr>`;
    });
}

async function createEmployee() {
    const name  = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const role  = document.getElementById('role').value;
    await axios.post(`${api}/employees`, { name, email, role });
    document.getElementById('name').value  = '';
    document.getElementById('email').value = '';
    loadEmployees();
}

async function deleteEmployee(id) {
    await axios.delete(`${api}/employees/${id}`);
    loadEmployees();
}

loadEmployees();
</script>
@endsection
