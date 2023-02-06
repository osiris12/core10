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
        $expected_data = [
            'Luke Skywalker' => [
                ['name' => 'X-wing'],
                ["name" => "Imperial shuttle"]
            ]
        ];

        $response = $this->getJson('api/people/luke/ships');

        $response
            ->assertJsonIsObject()
            ->assertJson($expected_data)
            ->assertStatus(200);

    }

    public function test_making_a_failed_api_request_for_ships_of_character()
    {
        $response = $this->get('/api/people/randomlettersasd/ships');

        $response->assertNotFound();
    }

    public function test_making_a_successful_api_request_for_species_classifications()
    {
        $expected_data = [
            "A New Hope" => [
                "Human" => [
                    "Classification" => "mammal"
                ]
            ]
        ];

        $response = $this->getJson('api/episode/1/species');

        $response
            ->assertJsonIsObject()
            ->assertJson($expected_data)
            ->assertStatus(200);
    }

    public function test_making_a_failed_api_request_for_species_classifications()
    {
        $response = $this->get('/api/episode/10/species');

        $response->assertStatus(500);
    }

    public function test_making_a_successful_api_request_for_population_of_universe()
    {
        $expected_data = [
            "Total population of the Star Wars universe" => 1711401432500
        ];


        $response = $this->getJson('/api/planet/population/all');

        $response
            ->assertJsonIsObject()
            ->assertJson($expected_data)
            ->assertStatus(200);
    }

    public function test_making_a_failed_api_request_for_population_of_universe()
    {
        $response = $this->get('/api/planet/population/allsas');

        $response->assertNotFound();
    }

}
