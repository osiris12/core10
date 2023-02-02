<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class SwapiClient extends Controller
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
        if (!isset($this->swapi)) {
            $this->swapi = $this->createHttpClient();
        }
        $response = $this->swapi->request('GET', $string);
        return json_decode($response->getBody()->getContents()) ?? null;
    }
}
