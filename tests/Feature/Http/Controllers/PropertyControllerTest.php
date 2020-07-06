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
            ]);

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'suburb' => 'Sally',
                'state' => 'TestState',
                'country' => 'TestCountry'
            ]);
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
            ]);
    }
}
