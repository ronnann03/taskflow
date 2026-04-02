# TaskFlow 🗂️

Sistema de gestión de tareas y empleados construido con Laravel 11, JavaScript y C#.

## Tecnologías
- **Backend:** PHP 8.4, Laravel 11, MySQL 9.3
- **API:** RESTful con Laravel Sanctum
- **Frontend:** Blade + JavaScript + Axios + Tailwind CSS
- **Cliente externo:** C# Console App (.NET 10)

## Instalación

### Requisitos
- PHP 8.4
- Composer
- MySQL 9.3
- .NET 10 SDK

### Pasos
```bash
git clone <tu-repo>
cd taskflow
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Endpoints API

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | /api/v1/employees | Listar empleados |
| POST | /api/v1/employees | Crear empleado |
| GET | /api/v1/employees/{id} | Ver empleado |
| PUT | /api/v1/employees/{id} | Actualizar empleado |
| DELETE | /api/v1/employees/{id} | Eliminar empleado |
| GET | /api/v1/tasks | Listar tareas |
| POST | /api/v1/tasks | Crear tarea |
| GET | /api/v1/tasks/{id} | Ver tarea |
| PUT | /api/v1/tasks/{id} | Actualizar tarea |
| DELETE | /api/v1/tasks/{id} | Eliminar tarea |

## Cliente C#
```bash
cd TaskFlowClient
dotnet run
```

## Autor
Ronaldinho — Proyecto de aprendizaje
