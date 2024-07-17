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
        'birthday' => $data['dateOfBirth'],
        'primary_phone' => $data['userPhoneNumber'],
        'job_title' => $data['jobPosition']
      ];
    }
}
