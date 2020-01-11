<?php

namespace App\Services;

use GuzzleHttp\Client;

Class WeatherApi implements WeatherApiInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @return array|null
     */
    public function call(float $latitude, float $longitude): ?array
    {
        $url = sprintf(
            'https://api.darksky.net/forecast/ea8b6ae5fda65f4ae7e214ad8fedfc6a/%s,%s/',
            $latitude,
            $longitude
        );

        $response = $this->client->get($url, ['query' => ['exclude' => 'flags,hourly', 'units' => 'ca']]);

        return json_decode($response->getBody(), true);
    }
}
