<?php

namespace App\EmployeeProviders;

class FacebookEmployeeProvider extends BaseEmployeeProvider
{
    /**
     * List of required keys in the data array.
     *
     * @var array
     */
    public static $requiredKeys = [
        'employee_first_name',
        'employee_last_name',
        'employee_email',
        'employee_position',
    ];


    public static function mapSchema($data)
    {
        return [
            'first_name' => $data['employee_first_name'],
            'last_name' => $data['employee_last_name'],
            'email' => $data['employee_email'],
            'job_title' => $data['employee_position']
        ];
    }
}
