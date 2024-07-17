<?php

namespace App\EmployeeProviders;

class GoogleEmployeeProvider extends BaseEmployeeProvider
{
    public static function mapSchema($data)
    {
      return [
        'first_name' => $data['employee_first_name'],
        'last_name' => $data['employee_last_name'],
        'email' => $data['employee_email'],
        'birthday' => $data['data_of_birth'],
        'primary_phone' => $data['phone_nr'],
        'job_title' => $data['employee_position']
      ];
    }
}
