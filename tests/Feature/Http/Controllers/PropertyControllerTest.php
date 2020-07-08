<?php
/**
 * Created by PhpStorm.
 * User: rushinaidu
 * Date: 7/7/20
 * Time: 6:27 AM
 */

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
            ->assertStatus(400)
            ->assertJson([
                'response' => [
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
            ->assertStatus(400)
            ->assertJson([
                'response' => [
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
}
