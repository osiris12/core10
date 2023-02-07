<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

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
        try {
            $response = $this->swapi->request('GET', $string);
        } catch (ClientException $e) {
            Log::error($e->getMessage());
            return null;
        }
        return json_decode($response->getBody()->getContents()) ?? null;
    }
}
