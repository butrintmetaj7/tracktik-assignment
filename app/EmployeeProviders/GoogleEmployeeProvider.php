<?php

namespace App\EmployeeProviders;

class GoogleEmployeeProvider extends BaseEmployeeProvider
{
    /**
     * List of required keys in the data array.
     *
     * @var array
     */
    public static $requiredKeys = [
        'googleFirstName',
        'googleLastName',
        'userEmail',
        'jobPosition',
    ];


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
