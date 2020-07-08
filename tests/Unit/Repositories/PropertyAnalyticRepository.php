<?php

namespace Tests\Unit\Repositories;

use App\Models\PropertyAnalytic;
use App\Repositories\PropertyAnalyticRepository;
use Tests\TestCase;
use Mockery;

class PropertyAnalyticRepositoryTest extends TestCase
{
    public function testUpdateOrCreateMethodForExistingRecord()
    {
        $propertyModelMock = Mockery::mock(PropertyAnalytic::class);
        $propertyModelMock->shouldReceive('update')
            ->withAnyArgs()
            ->times(1)
            ->andReturn(true);

        $propertyModelMock->shouldReceive('where')
            ->withAnyArgs()
            ->times(4)
            ->andReturnSelf();;

        $propertyModelMock->shouldReceive('get')
            ->withAnyArgs()
            ->times(1)
            ->andReturnSelf();;

        $propertyModelMock->shouldReceive('first')
            ->withAnyArgs()
            ->times(1)
            ->andReturnSelf();

        $repository = new PropertyAnalyticRepository($propertyModelMock);
        $result = $repository->updateOrCreate([
            'property_id' => 1,
            'analytic_type_id' => 1,
            'value' => '123'
        ]);

        $this->assertInstanceOf(PropertyAnalytic::class, $result);
    }

    public function testUpdateOrCreateMethodForNewRecord()
    {
        $propertyModelMock = Mockery::mock(PropertyAnalytic::class);
        $propertyModelMock->shouldReceive('update')
            ->withAnyArgs()
            ->times(1)
            ->andReturn(false);

        $propertyModelMock->shouldReceive('where')
            ->withAnyArgs()
            ->times(2)
            ->andReturnSelf();

        $propertyModelMock->shouldReceive('create')
            ->withAnyArgs()
            ->times(1)
            ->andReturnSelf();

        $repository = new PropertyAnalyticRepository($propertyModelMock);
        $result = $repository->updateOrCreate([
            'property_id' => 1,
            'analytic_type_id' => 1,
            'value' => '123'
        ]);

        $this->assertInstanceOf(PropertyAnalytic::class, $result);
    }
}
