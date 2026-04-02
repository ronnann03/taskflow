<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            background-color: #2563eb;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 11px;
        }
        .employee {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .employee-header {
            background-color: #f3f4f6;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }
        .employee-header h2 {
            margin: 0;
            font-size: 14px;
            color: #1d4ed8;
        }
        .employee-header span {
            font-size: 11px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #e5e7eb;
            padding: 8px 12px;
            text-align: left;
            font-size: 11px;
        }
        td {
            padding: 8px 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 11px;
        }
        .status-pendiente   { color: #d97706; font-weight: bold; }
        .status-en_progreso { color: #2563eb; font-weight: bold; }
        .status-completada  { color: #16a34a; font-weight: bold; }
        .no-tasks {
            padding: 10px 15px;
            color: #999;
            font-style: italic;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>TaskFlow — Reporte de Tareas</h1>
        <p>Generado el {{ $date }} | Usuario: {{ $user->name }} ({{ $user->role }})</p>
    </div>

    @foreach($employees as $employee)
    <div class="employee">
        <div class="employee-header">
            <h2>{{ $employee->name }}</h2>
            <span>{{ $employee->email }} | Rol: {{ $employee->role }}</span>
        </div>

        @if($employee->tasks->isEmpty())
            <div class="no-tasks">Sin tareas asignadas.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Fecha límite</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee->tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td class="status-{{ $task->status }}">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                        <td>{{ $task->due_date ?? 'Sin fecha' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @endforeach

    <div class="footer">
        TaskFlow &copy; {{ date('Y') }} — Reporte generado automáticamente
    </div>
</body>
</html>