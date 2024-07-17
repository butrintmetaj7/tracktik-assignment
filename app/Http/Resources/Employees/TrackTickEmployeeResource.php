<?php

namespace App\Http\Resources\Employees;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackTickEmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'jobTitle' => $this->job_title
        ];
    }
}
