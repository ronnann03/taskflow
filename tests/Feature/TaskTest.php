<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private Employee $employee;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $this->employee = Employee::create([
            'name'  => 'Empleado Test',
            'email' => 'empleado@test.com',
            'role'  => 'developer',
        ]);
    }

    public function test_puede_listar_tareas(): void
    {
        Task::create([
            'employee_id' => $this->employee->id,
            'title'       => 'Tarea Test',
            'status'      => 'pendiente',
        ]);

        $response = $this->actingAs($this->admin)->getJson('/api/v1/tasks');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    public function test_puede_crear_tarea(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/api/v1/tasks', [
            'employee_id' => $this->employee->id,
            'title'       => 'Nueva Tarea',
            'status'      => 'pendiente',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Nueva Tarea']);
    }

    public function test_no_puede_crear_tarea_sin_titulo(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/api/v1/tasks', [
            'employee_id' => $this->employee->id,
            'status'      => 'pendiente',
        ]);

        $response->assertStatus(422);
    }

    public function test_puede_cambiar_status_de_tarea(): void
    {
        $task = Task::create([
            'employee_id' => $this->employee->id,
            'title'       => 'Tarea a actualizar',
            'status'      => 'pendiente',
        ]);

        $response = $this->actingAs($this->admin)->putJson("/api/v1/tasks/{$task->id}", [
            'status' => 'completada',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'completada']);
    }
}
