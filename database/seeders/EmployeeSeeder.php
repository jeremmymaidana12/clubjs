<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@clubjs.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Crear empleados
        $employees = [
            [
                'name' => 'María García',
                'email' => 'maria@clubjs.com',
                'password' => Hash::make('empleado123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Carlos López',
                'email' => 'carlos@clubjs.com',
                'password' => Hash::make('empleado123'),
                'role' => 'employee',
            ],
            [
                'name' => 'Ana Martínez',
                'email' => 'ana@clubjs.com',
                'password' => Hash::make('empleado123'),
                'role' => 'employee',
            ]
        ];

        foreach ($employees as $employee) {
            User::create($employee);
        }

        // Crear algunos clientes de ejemplo
        $customers = [
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'password' => Hash::make('cliente123'),
                'role' => 'customer',
            ],
            [
                'name' => 'Laura Rodríguez',
                'email' => 'laura@example.com',
                'password' => Hash::make('cliente123'),
                'role' => 'customer',
            ]
        ];

        foreach ($customers as $customer) {
            User::create($customer);
        }
    }
}
