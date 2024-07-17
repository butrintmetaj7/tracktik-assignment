<?php

namespace App\Rules;

use App\Helpers\EmployeeProviderHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmployeeProviderDataRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!self::validateData($value)) {
            $fail('The :attribute must be a valid provider schema.');
        }
    }


    /**
     * Validate the data array to ensure it includes all required keys.
     *
     * @param array $data
     * @return bool
     */
    public static function validateData($data): bool
    {
        $provider = request()->route('provider');

        foreach (EmployeeProviderHelper::providerClassName($provider)::$requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return false;
            }
        }
        return true;
    }

}
