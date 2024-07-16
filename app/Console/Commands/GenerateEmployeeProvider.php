<?php

namespace App\Console\Commands;

use App\Models\EmployeeProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateEmployeeProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:employee-provider {name}';


     /**
     * The file name extension
     *
     * @var string
     */
    private $extension = 'EmployeeProvider.php';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates a new employee provider that has its own schema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $employeeProvider = EmployeeProvider::firstOrCreate(['name' => $this->argument('name')]);

        if(!$employeeProvider){
            $this->error('Error: EmployeeProvider with this name cannot be created or found.');
            return;
        }

        $path = app_path('EmployeeProviders/' . $this->argument('name') . $this->extension);

        if (file_exists($path)) {
            $this->error('Error: A employee provider with this name already exists.');
            return;
        }

        file_put_contents($path, $this->compileTemplate());


        $this->info('Success: ' . $this->argument('name') . ' Employee Provider was added!');
    }


    protected function compileTemplate(): string
    {
        $stub = file_get_contents(app_path('EmployeeProviders/Console/EmployeeProvider.stub'));

        return str_replace('{{CLASS}}', $this->argument('name') . 'EmployeeProvider', $stub);
    }


}
