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
        $employeeData = EmployeeProviderHelper::mapEmployeeData(request('provider'), $request->data);

        $employee = Employee::create($employeeData);

        EmployeeCreated::dispatch($employee);

        return $this->sendResponse(compact('employee'), 'Employee Created!');
    }

    public function update(UpdateEmployeeRequest $request, $provider, Employee $employee)
    {
        $employeeData = EmployeeProviderHelper::mapEmployeeData($provider, $request->data);

        if(!$employee->update($employeeData)){
            return $this->sendError('Could not update employee!');
        }

        EmployeeUpdated::dispatch($employee);

        return $this->sendResponse(compact('employee'), 'Employee Updated!');
    }
}
