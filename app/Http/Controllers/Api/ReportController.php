<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function pdf(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $employees = Employee::with('tasks')->get();
        } else {
            $employees = Employee::with('tasks')
                ->where('id', $user->employee_id)
                ->get();
        }

        $pdf = Pdf::loadView('reports.tasks', [
            'employees' => $employees,
            'user'      => $user,
            'date'      => now()->format('d/m/Y H:i'),
        ]);

        return $pdf->download('taskflow-reporte.pdf');
    }
}
