<?php

namespace Tests\Unit\Repositories;

use App\Models\Property;
use App\Repositories\PropertyRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Mockery;

class PropertyRepositoryTest extends TestCase
{
    public function testCreateMethod()
    {
        $propertyModelMock = Mockery::mock(Property::class);
        $propertyModelMock->shouldReceive('create')
            ->withAnyArgs()
            ->times(1)
            ->andReturnSelf();

        $repository = new PropertyRepository($propertyModelMock);
        $result = $repository->create([]);

        $this->assertInstanceOf(Property::class, $result);
    }

    public function testAllMethod()
    {
        $propertyModelMock = Mockery::mock(Property::class);
        $propertyModelMock->shouldReceive('all')
            ->withAnyArgs()
            ->times(1)
            ->andReturns(new Collection());


        $repository = new PropertyRepository($propertyModelMock);
        $result = $repository->all();

       $this->assertInstanceOf(Collection::class, $result);
    }
}
