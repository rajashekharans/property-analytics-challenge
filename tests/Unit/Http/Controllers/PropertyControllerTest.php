<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Property;
use App\Http\Controllers\PropertyController;
use App\Models\PropertyAnalytic;
use App\Repositories\PropertyRepository;
use App\Repositories\PropertyAnalyticRepository;
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

        $propertyRepositoryMock = Mockery::mock(PropertyRepository::class);
        $propertyRepositoryMock->shouldReceive('create')
            ->withAnyArgs()
            ->once()
            ->andReturn($property);

        $propertyAnalyticRepositoryMock = Mockery::mock(PropertyAnalyticRepository::class);

        # When
        $controller = new PropertyController(
            $propertyRepositoryMock,
            $propertyAnalyticRepositoryMock
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

        $propertyRepositoryMock = Mockery::mock(PropertyRepository::class);
        $propertyanalyticRepositoryMock = Mockery::mock(PropertyAnalyticRepository::class);

        # When
        $controller = new PropertyController(
            $propertyRepositoryMock,
            $propertyanalyticRepositoryMock
        );
        $response = $controller->addProperty($requestMock);

        $data = json_decode(
            $response->getContent(),
            true
        );

        # Assert
        $this->assertEquals($expected, $data);
    }

    public function testCanAddUpdatePropertyAnalytic()
    {
        $requestParameters = [
            'analytic_type_id' => '1',
            'value' => '112'
        ];

        $expected = [
            'analytic_type_id' => '1',
            'value' => '112',
            'property_id' => '1',
            'updated_at' => '2020-07-05T13:48:12.000000Z',
            'created_at' => '2020-07-05T13:48:12.000000Z',
            'id' => 102
        ];

        $property = new PropertyAnalytic($expected);

        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('all')
            ->withAnyArgs()
            ->times(1)
            ->andReturn($requestParameters);

        $propertyRepositoryMock = Mockery::mock(PropertyRepository::class);
        $propertyAnalyticRepositoryMock = Mockery::mock(PropertyAnalyticRepository::class);

        $propertyAnalyticRepositoryMock->shouldReceive('updateOrCreate')
            ->withAnyArgs()
            ->once()
            ->andReturn($property);

        # When
        $controller = new PropertyController(
            $propertyRepositoryMock,
            $propertyAnalyticRepositoryMock
        );

        $property_id = 1;
        $response = $controller->addUpdatePropertyAnalytic($requestMock, $property_id);


        $data = json_decode(
            $response->getContent(),
            true
        );

        # Assert
        $this->assertEquals($expected, $data);
    }

    public function testCanAddUpdatePropertyAnalyticReturnsError()
    {
        $requestParameters = [
            'value' => '112'
        ];

        $expected = [
            'response' => [
                'analytic_type_id' => [
                    'The analytic type id field is required.'
                ],
            ],
        ];

        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('all')
            ->withAnyArgs()
            ->times(1)
            ->andReturn($requestParameters);

        $propertyRepositoryMock = Mockery::mock(PropertyRepository::class);
        $propertyAnalyticRepositoryMock = Mockery::mock(PropertyAnalyticRepository::class);

        # When
        $controller = new PropertyController(
            $propertyRepositoryMock,
            $propertyAnalyticRepositoryMock
        );

        $property_id = 1;
        $response = $controller->addUpdatePropertyAnalytic($requestMock, $property_id);


        $data = json_decode(
            $response->getContent(),
            true
        );

        $this->assertEquals($expected, $data);
    }
}
