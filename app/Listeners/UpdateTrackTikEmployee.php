<?php

namespace App\Listeners;

use App\Events\EmployeeUpdated;
use App\Http\Integrations\TrackTik\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateTrackTikEmployee
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
    public function handle(EmployeeUpdated $event): void
    {
        $employee = $event->employee;

        try {
            $this->employeeResource->update($employee);

        } catch (\Throwable $e) {
            Log::error('Failed to update employee in TrackTik', ['error' => $e->getMessage()]);
        }
    }
}
