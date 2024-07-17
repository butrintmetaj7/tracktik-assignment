<?php

namespace App\Http\Controllers\Api;

use App\Helpers\EmployeeProviderHelper;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends BaseController
{
    public function store(HttpRequest $request)
    {
        $provider = request()->route('provider');

        if(!EmployeeProviderHelper::providerExists($provider)){
            return $this->sendError(EmployeeProviderHelper::formattedProviderName($provider) . ' is not valid!');
        }

        $transformedEmployeeData = EmployeeProviderHelper::providerClassName($provider)::mapSchema($request->data);

        $employee = Employee::create($transformedEmployeeData);

        return $this->sendResponse([], 'Success');
    }
}
