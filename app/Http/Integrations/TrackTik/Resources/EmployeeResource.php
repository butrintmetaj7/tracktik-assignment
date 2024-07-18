<?php

namespace App\Http\Integrations\TrackTik\Resources;

use App\Http\Integrations\TrackTik\TrackTikConnector;
use App\Http\Resources\Employees\TrackTickEmployeeResource;
use App\Models\Employee;
use Throwable;

class EmployeeResource
{
    private $connector;

    public function __construct()
    {
        $this->connector = new TrackTikConnector();
    }

    public function create(Employee $employee): array
    {
        try {
            $response = $this->connector->send(
                method: 'POST',
                uri: '/employees',
                options: [
                    'json' =>  $this->mapTrackTikAttributes($employee),
                ],
            );
        } catch (Throwable $exception) {
            throw $exception;
        }

        return $response->json('data');
    }

    public function update(Employee $employee): array
    {
        try {
            $response = $this->connector->send(
                method: 'PUT',
                uri: "/employees/" . $employee->track_tik_id,
                options: [
                    'json' => $this->mapTrackTikAttributes($employee)
                ],
            );
        } catch (Throwable $exception) {
            throw $exception;
        }

        return $response->json('data');
    }



    private function mapTrackTikAttributes(Employee $employee): array
    {
        return [
            'firstName' => $employee->first_name,
            'lastName' => $employee->last_name,
            'email' => $employee->email,
            'jobTitle' => $employee->job_title
        ];
    }
}
