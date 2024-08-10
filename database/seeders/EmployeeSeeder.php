<?php

namespace Database\Seeders;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->delete();

        $employees = [
            [
                'name' => 'John Doe',
                'address' => '123 Main St, Anytown, USA',
                'phone_number' => '555-1234',
                'position' => 'Manager',
                'hire_date' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'address' => '456 Oak Ave, Somewhere, USA',
                'phone_number' => '555-5678',
                'position' => 'Developer',
                'hire_date' => now()->subMonths(3),
            ],
            // Add more employee data as needed
        ];

        foreach ($employees as $employeeData) {
            Employee::create($employeeData);
        }
    }
}
