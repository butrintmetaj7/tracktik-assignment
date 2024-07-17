<?php

namespace App\Http\Controllers;

namespace App\Http\Integrations\TrackTik;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;


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
}
