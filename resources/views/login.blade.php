<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow — Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded shadow p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-blue-600 mb-6 text-center">TaskFlow</h1>

        <div id="error" class="hidden bg-red-100 text-red-700 px-4 py-2 rounded mb-4"></div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input id="email" type="email" class="border rounded px-3 py-2 w-full" placeholder="admin@taskflow.com">
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Contraseña</label>
            <input id="password" type="password" class="border rounded px-3 py-2 w-full" placeholder="••••••••">
        </div>
        <button onclick="login()" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Iniciar Sesión
        </button>
    </div>

<script>
async function login() {
    const email    = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const res = await axios.post('http://127.0.0.1:8000/api/v1/login', { email, password });
        localStorage.setItem('token', res.data.token);
        localStorage.setItem('user', JSON.stringify(res.data.user));
        window.location.href = '/employees';
    } catch (e) {
        const err = document.getElementById('error');
        err.textContent = 'Credenciales incorrectas';
        err.classList.remove('hidden');
    }
}
</script>
</body>
</html>