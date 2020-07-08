<?php

namespace Tests\Unit\Repositories;

use App\Models\PropertyAnalytic;
use App\Repositories\PropertyAnalyticRepository;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Mockery;

class PropertyAnalyticRepositoryTest extends TestCase
{
    public function testUpdateOrCreateMethodForExisitingRecord()
    {
        $propertyModelMock = Mockery::mock(PropertyAnalytic::class);
        $propertyModelMock->shouldReceive('update')
            ->withAnyArgs()
            ->times(1)
            ->andReturn(true);

        $propertyModelMock->shouldReceive('where')
            ->withAnyArgs()
            ->times(4);

        $propertyModelMock->shouldReceive('get')
            ->withAnyArgs()
            ->times(1);

        $propertyModelMock->shouldReceive('first')
            ->withAnyArgs()
            ->times(1)
            ->andReturnSelf();

        $repository = new PropertyAnalyticRepository($propertyModelMock);
        $result = $repository->updateOrCreate([]);

        $this->assertInstanceOf(PropertyAnalytic::class, $result);
    }

    public function testUpdateOrCreateMethodForNewRecord()
    {
        $propertyModelMock = Mockery::mock(PropertyAnalytic::class);
        $propertyModelMock->shouldReceive('update')
            ->withAnyArgs()
            ->times(1)
            ->andReturn(true);

        $propertyModelMock->shouldReceive('where')
            ->withAnyArgs()
            ->times(2);

        $propertyModelMock->shouldReceive('create')
            ->withAnyArgs()
            ->times(1)
            ->andReturnSelf();

        $repository = new PropertyAnalyticRepository($propertyModelMock);
        $result = $repository->updateOrCreate([]);

        $this->assertInstanceOf(PropertyAnalytic::class, $result);
    }

    public function testAllMethod()
    {
        $propertyModelMock = Mockery::mock(PropertyAnalytic::class);
        $propertyModelMock->shouldReceive('all')
            ->withAnyArgs()
            ->times(1)
            ->andReturns(new Collection());

        $repository = new PropertyAnalyticRepository($propertyModelMock);
        $result = $repository->all();

        $this->assertInstanceOf(Collection::class, $result);
    }
}
