<?php

namespace App\Http\Controllers;

use App\Api\SwapiClient;
use Illuminate\Http\Response;

class EpisodeController extends SwapiClient
{
    public function __construct(
        public SpeciesController $species
    ) {}

    public function episode($number): Response
    {
        $episode = $this->getEpisode($number) ?? null;
        if($episode) {
            return response((array) $episode, 200);
        } else {
            return response(["Error" => "Episode $number does not exists......yet"], 404);
        }
    }

    public function getEpisode($number): object|null
    {
        return $this->makeRequest("films/$number/") ?? null;
    }

    public function showAllSpeciesClassifications($number): Response
    {
        $episode = $this->getEpisode($number);
        if ($episode) {
            return response([$episode->title => $this->species->getSpeciesClassifications($episode->species)], 200);
        } else {
            return response([], 500);
        }
    }
}
