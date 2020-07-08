<?php

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    public function findPropertyAnalyticsByPropertyId(int $propertyId): Collection
    {
        return $this->model->find($propertyId)->propertyAnalytics()->get();
    }
}
