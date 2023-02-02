<?php

namespace App\Http\Controllers;

use App\Api\SwapiClient;

class SpeciesController extends SwapiClient
{
    public function getSpeciesClassifications(array $species)
    {
        $classifications = [];
        foreach ($species as $index => $link) {
            $response = $this->makeRequest(explode('api/', $link)[1]);
            $classifications[$response->name] = ['Classification' => $response->classification];
        }
        return $classifications;
    }
}
