<?php

namespace Database\Seeders;

use App\Models\EmployeeProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class EmployeeProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Artisan::call('make:employee-provider', ['name' => 'Instagram']);
        // Artisan::call('make:employee-provider', ['name' => 'X']);

        EmployeeProvider::factory()->createMany([['name' => 'Google'],['name' => 'Facebook']]);
    }
}
