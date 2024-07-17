<?php

namespace App\EmployeeProviders;

class FacebookEmployeeProvider extends BaseEmployeeProvider
{
    public static function mapSchema($data)
    {
      return [
        'first_name' => $data['googleFirstName'],
        'last_name' => $data['googleLastName'],
        'email' => $data['userEmail'],
        'job_title' => $data['jobPosition']
      ];
    }
}
