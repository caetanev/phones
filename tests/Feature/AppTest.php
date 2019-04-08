<?php

namespace Tests\Feature;

use App\Models\CountryPhone;
use App\Models\PhoneState;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * Verify if the gri is accessible through a GET request.
     *
     * @return void
     */
    public function testGridAsGetRequest()
    {
        $response = $this->get('/grid');
        $response->assertStatus(405);
    }

    /**
     * Check if the filter by country is working properly for ...
     *
     * @return void
     */
    public function testGridWithCountryFilter()
    {
        $countryPhone = CountryPhone::inRandomOrder()->first();

        /**
         * ... a random VALID country
         */
        $uri = "/grid?countryId={$countryPhone->id}";
        $response = $this->post($uri);
        $response->assertStatus(200);

        /**
         * ... a INVALID country id
         */
        $uri = "/grid?countryId=invalid";
        $response = $this->postJson($uri);
        $response->assertStatus(422);
    }

    /**
     * Check if the filter by state is working properly for ...
     *
     * @return void
     */
    public function testGridWithStateFilter()
    {
        $phoneState = PhoneState::inRandomOrder()->first();

        /**
         * ... a random VALID state
         */
        $uri = "/grid?validPhone={$phoneState->id}";
        $response = $this->post($uri);
        $response->assertStatus(200);

        /**
         * ... a INVALID state id
         */
        $uri = "/grid?validPhone=invalid";
        $response = $this->postJson($uri);
        $response->assertStatus(422);
    }

    /**
     * Check if the filter by country and state is working properly for ...
     *
     * @return void
     */
    public function testGridWithCountryAndStateFilter()
    {
        $phoneState = PhoneState::inRandomOrder()->first();
        $countryPhone = CountryPhone::inRandomOrder()->first();

        /**
         * ... a random VALID country and VALID state
         */
        $uri = "/grid?countryId={$countryPhone->id}&validPhone={$phoneState->id}";
        $response = $this->post($uri);
        $response->assertStatus(200);

        /**
         * ... a random VALID country and INVALID state id
         */
        $uri = "/grid?countryId={$countryPhone->id}&validPhone=invalid";
        $response = $this->postJson($uri);
        $response->assertStatus(422);

        /**
         * ... a random INVALID country id and VALID state
         */
        $uri = "/grid?countryId=invalid&validPhone={$phoneState->id}";
        $response = $this->postJson($uri);
        $response->assertStatus(422);
    }
}
