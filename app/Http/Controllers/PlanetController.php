<?php

namespace App\Http\Controllers;

use App\Api\SwapiClient;

class PlanetController extends SwapiClient
{
    public function showPopulationOfUniverse()
    {
        $planets = $this->getPlanets();
        return $this->getPopulationOfUniverse($planets);
    }

    public function getPlanets(): object|null
    {
        return $this->makeRequest("planets/") ?? null;
    }

    public function getPopulationOfUniverse($planet_pages): array
    {
        $population = 0;
        while (!is_null($planet_pages)) {
            $next_page = $planet_pages->next ?? null;
            $planets = $planet_pages->results;
            foreach ($planets as $planet) {
                $population += is_numeric($planet->population) ? (int) $planet->population : 0;
            }
            if (!is_null($next_page)) {
                $planet_pages = $this->makeRequest(explode('api/', $next_page)[1]);
            } else {
                break;
            }
        }
        return ['Total population of the Star Wars universe' => $population];
    }
}
