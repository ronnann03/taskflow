# TaskFlow 🗂️

Sistema de gestión de tareas y empleados construido con Laravel 11, JavaScript y C#.

## Tecnologías
- **Backend:** PHP 8.4, Laravel 11, MySQL 9.3
- **API:** RESTful con Laravel Sanctum
- **Frontend:** Blade + JavaScript + Axios + Tailwind CSS
- **Tiempo real:** Laravel Reverb + Pusher JS
- **Cliente externo:** C# Console App (.NET 10)
- **PDF:** DomPDF (barryvdh/laravel-dompdf)

## Features implementados
- ✅ API REST con 10 endpoints (CRUD completo)
- ✅ Autenticación con tokens Bearer (Sanctum)
- ✅ Sistema de roles (admin / developer / designer)
- ✅ Frontend con login real y token en localStorage
- ✅ Tareas en tiempo real con WebSockets (Reverb + Pusher)
- ✅ Export de reporte en PDF
- ✅ Cliente C# que consume la API REST
- ✅ 10 tests automatizados con PHPUnit

## Instalación

### Requisitos
- PHP 8.4
- Composer
- MySQL 9.3
- Node.js
- .NET 10 SDK

### Pasos
```bash
git clone https://github.com/ronnann03/taskflow.git
cd taskflow
composer install
cp .env.example .env
php artisan key:generate
# Configurar DB en .env
php artisan migrate
php artisan serve
```

### WebSockets
```bash
php artisan reverb:start
```

### Cliente C#
```bash
cd TaskFlowClient
dotnet run
```

## Endpoints API

| Método | Ruta | Descripción | Auth |
|--------|------|-------------|------|
| POST | /api/v1/register | Registrar usuario | ❌ |
| POST | /api/v1/login | Iniciar sesión | ❌ |
| POST | /api/v1/logout | Cerrar sesión | ✅ |
| GET | /api/v1/me | Usuario actual | ✅ |
| GET | /api/v1/employees | Listar empleados | ✅ Admin |
| POST | /api/v1/employees | Crear empleado | ✅ Admin |
| GET | /api/v1/employees/{id} | Ver empleado | ✅ Admin |
| PUT | /api/v1/employees/{id} | Actualizar empleado | ✅ Admin |
| DELETE | /api/v1/employees/{id} | Eliminar empleado | ✅ Admin |
| GET | /api/v1/tasks | Listar tareas | ✅ |
| POST | /api/v1/tasks | Crear tarea | ✅ |
| GET | /api/v1/tasks/{id} | Ver tarea | ✅ |
| PUT | /api/v1/tasks/{id} | Actualizar tarea | ✅ |
| DELETE | /api/v1/tasks/{id} | Eliminar tarea | ✅ |
| GET | /api/v1/reports/pdf | Descargar PDF | ✅ |

## Sistema de roles
- **Admin:** acceso completo a empleados y tareas
- **Developer / Designer:** solo ven sus propias tareas

## Tests
```bash
php artisan test
```
```
Tests: 10 passed (16 assertions)
```

## Autor
Ronaldinho — Proyecto de aprendizaje 