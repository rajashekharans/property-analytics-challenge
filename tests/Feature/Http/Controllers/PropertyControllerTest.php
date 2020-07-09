<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyControllerTest extends TestCase
{

    public function testAddPropertySuccess()
    {
        $response = $this->postJson(
            env('APP_URL').'/api/properties',
            [
                'suburb' => 'Sally',
                'state' => 'TestState',
                'country' => 'TestCountry'
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'suburb' => 'Sally',
                'state' => 'TestState',
                'country' => 'TestCountry'
            ]
        );
    }

    public function testAddPropertyReturnsError()
    {
        $response = $this->postJson(
            env('APP_URL').'/api/properties',
            [
                'suburb' => 'Sally',
                'state' => 'TestState',
            ]);

        $response
            ->assertStatus(422)
            ->assertJson([
                'messages' => [
                    'country' => [
                        'The country field is required.'
                    ],
                ],
            ]
        );
    }

    public function testAddPropertyAnalyticSuccess()
    {
        $response = $this->putJson(
            env('APP_URL').'/api/properties/1/property-analytics',
            [
                'analytic_type_id' => 1,
                'value' => 11
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'property_id' => 1,
                'analytic_type_id' => 1,
                'value' => '11'
            ]
        );
    }

    public function testAddPropertyAnalyticReturnsError()
    {
        $response = $this->putJson(
            env('APP_URL').'/api/properties/1/property-analytics',
            [
                'value' => 11
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJson([
                'messages' => [
                    'analytic_type_id' => [
                        'The analytic type id field is required.'
                    ],
                ],
            ]
        );
    }

    public function testGetPropertAnalyticsByPropertyId()
    {
        $response = $this->get(
            env('APP_URL').'/api/properties/12/property-analytics'
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                    [
                        'property_id' => 12,
                    ],
                ]
            );
    }

    public function testGetPropertAnalyticsByStateSuccess()
    {
        $response = $this->get(
            env('APP_URL').'/api/properties/property-analytics?state=NSW&analytic_type_id=3'
        );

        $response->assertStatus(200);
    }

    public function testGetPropertAnalyticsByStateError()
    {
        $response = $this->get(
            env('APP_URL').'/api/properties/property-analytics?test=NSW&analytic_type_id=3'
        );

        $response
            ->assertStatus(422)
            ->assertJson([
                'messages' => [
                    'field' => [
                        'One of the required field in [suburb, state, country] is missing.'
                    ],
                ],
            ]);
    }
}
