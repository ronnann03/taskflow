<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-600 text-white px-6 py-4 flex gap-6 shadow">
        <a href="/" class="font-bold text-lg">TaskFlow</a>
        <a href="/employees" class="hover:underline">Empleados</a>
        <a href="/tasks" class="hover:underline">Tareas</a>
    </nav>

    <main class="max-w-5xl mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>