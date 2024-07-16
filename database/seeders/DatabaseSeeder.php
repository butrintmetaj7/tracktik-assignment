<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeProvider;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmployeeProviderSeeder::class,
        ]);

    }
}
