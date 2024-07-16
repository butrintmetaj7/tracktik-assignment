<?php

namespace App\EmployeeProviders;

class GoogleEmployeeProvider extends BaseEmployeeProvider
{
    public function mapSchema($data)
    {
      // define how the schema will be transformed
      return [];
    }
}
