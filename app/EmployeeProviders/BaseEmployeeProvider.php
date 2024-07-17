<?php

namespace App\EmployeeProviders;

abstract class BaseEmployeeProvider
{
    abstract public static function mapSchema($data);
}
