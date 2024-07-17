<?php

namespace App\Http\Controllers;

namespace App\Http\Integrations\TrackTik\Resources;

use App\Http\Integrations\TrackTik\TrackTikConnector;
use App\Http\Resources\Employees\TrackTickEmployeeResource;
use App\Models\Employee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Throwable;


final readonly class EmployeeResource
{
    public function __construct(
        private TrackTikConnector $connector,
    ) {}

    public function create(Employee $employee): array
    {
        try {
            $response = $this->connector->send(
                method: 'POST',
                uri: "/employees",
                options: new TrackTickEmployeeResource($employee),
            );
        } catch (Throwable $exception) {
            throw $exception;
        }

        return $response->json('data');

        // update employee save track_tick_id
    }

    public function update(Employee $employee): array
    {
        try {
            $response = $this->connector->send(
                method: 'PUT',
                uri: "/employees/" . $employee->track_tik_id,
                options: new TrackTickEmployeeResource($employee),
            );
        } catch (Throwable $exception) {
            throw $exception;
        }

        return $response->json('data');
    }
}
