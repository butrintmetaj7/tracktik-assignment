<?php

namespace App\EmployeeProviders;

class FacebookEmployeeProvider extends BaseEmployeeProvider
{
    public function mapSchema($data)
    {
      return [
        'name' => $data['full_name'],
        'email' => $data['employee_email'],
        'birthday' => $data['employee_birthdays']
      ];
    }
}
