<?php

namespace App\Listeners;

use App\Events\EmployeeCreated;
use App\Http\Integrations\TrackTik\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateTrackTikEmployee implements ShouldQueue
{

    protected EmployeeResource $employeeResource;

    /**
     * Create the event listener.
     */
    public function __construct(EmployeeResource $employeeResource)
    {
        $this->employeeResource = $employeeResource;
    }

    /**
     * Handle the event.
     */
    public function handle(EmployeeCreated $event): void
    {
        try {
            $employee = $event->employee;

            $response = $this->employeeResource->create($employee);

            $employee->track_tik_id = $response['id'];

            $employee->save();

        } catch (\Throwable $e) {
            // Handle the exception as needed
            Log::error('Failed to create employee in TrackTik', ['error' => $e->getMessage()]);
        }
    }
}
