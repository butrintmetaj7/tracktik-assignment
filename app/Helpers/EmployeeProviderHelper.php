<?php

namespace App\Helpers;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeProviderHelper extends FormRequest
{
    /**
     * Validate that the provider class exists.
     *
     * @param $provider
     * @return bool
     */
    public static function providerExists($provider): bool
    {
        $providerClass = 'App\\EmployeeProviders\\' . self::formattedProviderName($provider) . 'EmployeeProvider';

        return class_exists($providerClass);
    }

    public static function formattedProviderName($provider): string
    {
       return ucfirst(strtolower($provider));
    }
}
