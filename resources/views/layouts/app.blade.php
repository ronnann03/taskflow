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

    <nav class="bg-blue-600 text-white px-4 py-3 shadow">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <a href="/" class="font-bold text-lg">📋 TaskFlow</a>

            {{-- Menu hamburguesa mobile --}}
            <button id="menu-toggle" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Menu desktop --}}
            <div class="hidden md:flex items-center gap-6">
                <a href="/employees" class="hover:underline">👥 Empleados</a>
                <a href="/tasks" class="hover:underline">📝 Tareas</a>
                <button onclick="logout()" class="bg-white text-blue-600 px-3 py-1 rounded text-sm font-medium hover:bg-gray-100">
                    Cerrar sesión
                </button>
            </div>
        </div>

        {{-- Menu mobile desplegable --}}
        <div id="mobile-menu" class="hidden md:hidden mt-3 flex flex-col gap-2 border-t border-blue-500 pt-3">
            <a href="/employees" class="hover:underline">👥 Empleados</a>
            <a href="/tasks" class="hover:underline">📝 Tareas</a>
            <button onclick="logout()" class="text-left bg-white text-blue-600 px-3 py-1 rounded text-sm font-medium hover:bg-gray-100 w-fit">
                Cerrar sesión
            </button>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto p-4 md:p-6">
        @yield('content')
    </main>

<script>
document.getElementById('menu-toggle').addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});

function logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    window.location.href = '/login';
}
</script>

</body>
</html>