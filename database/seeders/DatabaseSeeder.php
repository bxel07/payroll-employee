<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

# 
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\WorkSchedulesSeeder;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(WorkSchedulesSeeder::class);
    }
}
