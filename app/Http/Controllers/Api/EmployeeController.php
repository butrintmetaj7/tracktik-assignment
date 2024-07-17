<?php

namespace App\Http\Controllers\Api;

use App\Events\EmployeeCreated;
use App\Events\EmployeeUpdated;
use App\Helpers\EmployeeProviderHelper;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;

class EmployeeController extends BaseController
{
    public function store(StoreEmployeeRequest $request)
    {
        $provider = request()->route('provider');

        $mappedEmployeeData = EmployeeProviderHelper::providerClassName($provider)::mapSchema($request->data);

        $employee = Employee::create($mappedEmployeeData);

        EmployeeCreated::dispatch($employee);

        return $this->sendResponse(compact('employee'), 'Employee Created!');
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $provider = request()->route('provider');

        $transformedEmployeeData = EmployeeProviderHelper::providerClassName($provider)::mapSchema($request->data);

        if(!$employee->update($transformedEmployeeData)){
            return $this->sendError('Could not update employee!');
        }

        EmployeeUpdated::dispatch($employee);

        return $this->sendResponse(compact('employee'), 'Employee Updated!');
    }
}
