<?php

namespace App\Http\Controllers;

namespace App\Http\Integrations\TrackTik;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

final readonly class TrackTikConnector
{
    public function __construct(
        private PendingRequest $request,
    ) {}

    public static function register(Application $app): void
    {
        $app->bind(
            abstract: TrackTikConnector::class,
            concrete: fn () => new TrackTikConnector(
                request: Http::baseUrl(
                    url: config('services.tracktik.url'),
                )->timeout(
                    seconds: 15,
                )->withHeaders(
                    headers: [
                        'Authorization' => 'Bearer ' . config('services.tracktik.token'),
                    ],
                )->asJson()->acceptJson(),
            ),
        );
    }

    public function send(string $method, string $uri, array $options = []): Response
    {
        return $this->request->$method($uri, $options);
    }
}
