<?php

namespace App\Http\Integrations\TrackTik;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class TrackTikConnector
{
    private $token;
    private $refreshToken;

    public function __construct()
    {
        $this->token = Cache::get('tracktik_access_token');
        $this->refreshToken = Cache::get('tracktik_refresh_token');

        if (!$this->token || $this->isTokenExpired()) {
            $this->refreshToken();
        }
    }

    private function refreshToken()
    {
        $response = Http::post(config('services.tracktik.oauth2_url'), [
            'client_id' => config('services.tracktik.client_id'),
            'client_secret' => config('services.tracktik.client_secret'),
            'refresh_token' => $this->refreshToken ?: config('services.tracktik.refresh_token'),
            'grant_type' => 'refresh_token'
        ]);

        if ($response->successful()) {
            $this->token = $response->json()['access_token'];
            $this->refreshToken = $response->json()['refresh_token'];
            // Store tokens in cache
            Cache::put('tracktik_access_token', $this->token, now()->addSeconds($response->json()['expires_in']));
            Cache::put('tracktik_refresh_token', $this->refreshToken);
        } else {
            throw new \Exception('Failed to refresh token');
        }
    }

    private function isTokenExpired(): bool
    {
        return !Cache::has('tracktik_access_token');
    }

    /**
     * @throws ConnectionException
     */
    public function send(string $method, string $uri, array $options = [])
    {
        if ($this->isTokenExpired()) {
            $this->refreshToken();
        }

        $response = Http::withToken($this->token)->send(
            $method,
            config('services.tracktik.url') . $uri,
            $options
        );

        if ($response->failed()) {
            throw new \Exception('API request failed: ' . $response->body());
        }

        return $response;
    }
}
