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
        return class_exists(self::providerClassName($provider));
    }

    /**
     * Format provider name to upper case
     *
     * @param $provider
     * @return string
     */
    public static function formattedProviderName($provider): string
    {
       return ucfirst(strtolower($provider));
    }

    /**
     * Full path to the provider class
     *
     * @param $provider
     * @return string
     */
    public static function providerClassName($provider): string
    {
        return 'App\\EmployeeProviders\\' . self::formattedProviderName($provider) . 'EmployeeProvider';
    }
}
