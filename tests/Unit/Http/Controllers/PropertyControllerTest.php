<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Property;
use App\Http\Controllers\PropertyController;
use App\Repositories\PropertyRepository;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;

class PropertyControllerTest extends TestCase
{
    public function testCanAddProperty()
    {
        $requestParameters = [
            'suburb' => 'TestSuburb',
            'state' => 'TestState',
            'country' => 'TestCountry'
        ];

        $expected = [
            'suburb' => 'TestSuburb',
            'state' => 'TestState',
            'country' => 'TestCountry',
            'updated_at' => '2020-07-05T13:48:12.000000Z',
            'created_at' => '2020-07-05T13:48:12.312863Z',
            'guid' => '90f8336f-a4b2-4ca1-8185-ca4ce7c6e259',
            'id' => 102
        ];

        $property = new Property($expected);

        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('all')
            ->withAnyArgs()
            ->times(2)
            ->andReturn($requestParameters);

        $repositoryMock = Mockery::mock(PropertyRepository::class);
        $repositoryMock->shouldReceive('create')
            ->withAnyArgs()
            ->once()
            ->andReturn($property);


        # When
        $controller = new PropertyController(
            $repositoryMock
        );
        $response = $controller->addProperty($requestMock);

        $data = json_decode(
            $response->getContent(),
            true
        );

        # Assert
        $this->assertEquals($expected, $data);
    }

    public function testAddPropertyReturnsError()
    {
        $requestParameters = [
            'state' => 'TestState',
            'country' => 'TestCountry'
        ];

        $expected = [
            'response' => [
                'suburb' => [
                    'The suburb field is required.'
                ],
            ],
        ];

        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('all')
            ->withAnyArgs()
            ->times(1)
            ->andReturn($requestParameters);

        $repositoryMock = Mockery::mock(PropertyRepository::class);

        # When
        $controller = new PropertyController(
            $repositoryMock
        );
        $response = $controller->addProperty($requestMock);

        $data = json_decode(
            $response->getContent(),
            true
        );

        # Assert
        $this->assertEquals($expected, $data);
    }
}
