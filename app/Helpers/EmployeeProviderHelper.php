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
     * Map the schema for the given provider and data.
     *
     * @param string $provider
     * @param array $data
     * @return array
     */
    public static function mapEmployeeData($provider, $data)
    {
        $providerClass = self::providerClassName($provider);

        $mappedData = $providerClass::mapSchema($data);

        return array_merge($mappedData, ['provider' => $provider]);
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
