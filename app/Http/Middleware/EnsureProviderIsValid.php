<?php

namespace App\Http\Middleware;

use App\Helpers\EmployeeProviderHelper;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProviderIsValid
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $provider = $request->route('provider');

        if (!EmployeeProviderHelper::providerExists($provider)) {
            return $this->sendError(
                EmployeeProviderHelper::formattedProviderName($provider) . ' is not a valid employee provider!',
                [], 400);
        }

        return $next($request);
    }
}
