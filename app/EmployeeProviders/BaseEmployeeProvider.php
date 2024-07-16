<?php

namespace App\EmployeeProviders;

abstract class BaseEmployeeProvider
{
    abstract public function mapSchema($data);
}
