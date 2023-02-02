<?php

namespace App\Api;

use GuzzleHttp\Client;

class SwapiClient
{
    public Client $swapi;

    public function __construct()
    {
        $this->swapi = $this->createHttpClient();
    }

    protected function createHttpClient(): Client
    {
        return new Client([
            'base_uri' => 'https://swapi.dev/api/',
        ]);
    }

    public function makeRequest(string $string): array|object|null
    {
        $response = $this->swapi->request('GET', $string);
        return json_decode($response->getBody()->getContents()) ?? null;
    }
}
