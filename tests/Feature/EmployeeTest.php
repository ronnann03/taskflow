<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_listar_empleados(): void
    {
        Employee::create([
            'name'  => 'Test User',
            'email' => 'test@test.com',
            'role'  => 'admin',
        ]);

        $response = $this->getJson('/api/v1/employees');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    public function test_puede_crear_empleado(): void
    {
        $response = $this->postJson('/api/v1/employees', [
            'name'  => 'Nuevo Empleado',
            'email' => 'nuevo@test.com',
            'role'  => 'developer',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Nuevo Empleado']);
    }

    public function test_no_puede_crear_empleado_sin_email(): void
    {
        $response = $this->postJson('/api/v1/employees', [
            'name' => 'Sin Email',
            'role' => 'admin',
        ]);

        $response->assertStatus(422);
    }

    public function test_puede_eliminar_empleado(): void
    {
        $employee = Employee::create([
            'name'  => 'A Eliminar',
            'email' => 'eliminar@test.com',
            'role'  => 'designer',
        ]);

        $response = $this->deleteJson("/api/v1/employees/{$employee->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
