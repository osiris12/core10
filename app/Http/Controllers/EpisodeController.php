<?php

namespace App\Http\Controllers;

use App\Api\SwapiClient;

class EpisodeController extends SwapiClient
{
    public function __construct(
        public SpeciesController $species
    ) {}

    public function getEpisode($number): object|null
    {
        return $this->makeRequest("films/$number/") ?? null;
    }

    public function showAllSpeciesClassifications($number)
    {
        $episode = $this->getEpisode($number);
        $species_classifications = [];
        if ($episode) {
            $species_classifications = $this->species->getSpeciesClassifications($episode->species);
        }
        return $species_classifications;
    }
}
