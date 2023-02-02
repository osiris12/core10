<?php

namespace App\Http\Controllers;

use App\Api\SwapiClient;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function __construct(
        public SwapiClient $swapi
    ) {}

    public function show(string $name)
    {
        $person = $this->getPerson($name);
        if($person) {
            $starships = $this->getAssociatedStarships($person->starships);
            return response([$name => $starships], 200);
        } else {
            return response(["Error" => "$name does not exist in the star wars universe."], 404);
        }
    }

    public function getPerson(string $name): object|null
    {
        $response = $this->swapi->makeRequest("people/?search=$name");
        return $response->results[0] ?? null;
    }

    public function getAssociatedStarships(array $starship_links): array
    {
        $ships = [];
        foreach ($starship_links as $index => $starship_link) {
            $endpoint = explode('api/', $starship_link)[1];
            $ships[] = $this->swapi->makeRequest($endpoint);
        }
        return $ships;
    }
}
