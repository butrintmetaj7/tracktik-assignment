<?php

namespace App\Http\Middleware;

use App\Helpers\EmployeeProviderHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProviderIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $provider = $request->route('provider');

        if (!EmployeeProviderHelper::providerExists($provider)) {
            return response()->json(['error' => EmployeeProviderHelper::formattedProviderName($provider) . ' is not valid!'], 400);
        }

        return $next($request);
    }
}
