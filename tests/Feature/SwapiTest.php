<?php

namespace Tests\Feature;

use App\Api\SwapiClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SwapiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_making_a_successful_api_request_for_ships_of_character()
    {
        $response = $this->get('/api/people/luke/ships');

        $response->assertStatus(200);
    }

    public function test_making_a_failed_api_request_for_ships_of_character()
    {
        $response = $this->get('/api/people/randomlettersasd/ships');

        $response->assertStatus(404);
    }

    public function test_making_a_successful_api_request_for_species_classifications()
    {
        $response = $this->get('/api/episode/1/species');

        $response->assertStatus(200);
    }

    public function test_making_a_failed_api_request_for_species_classifications()
    {
        $response = $this->get('/api/episode/10/species');

        $response->assertStatus(500);
    }

    public function test_making_a_successful_api_request_for_population_of_universe()
    {
        $response = $this->get('/api/planet/population/all');

        $response->assertStatus(200);
    }

    public function test_making_a_failed_api_request_for_population_of_universe()
    {
        $response = $this->get('/api/planet/population/allsas');

        $response->assertStatus(404);
    }

}
