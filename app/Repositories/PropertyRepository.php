<?php

namespace App\Repositories;

use App\Models\Property;
use App\Models\PropertyAnalytic;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
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

    public function findPropertyByFieldName(string $fieldName, string $fieldValue): Collection
    {
        return $this->model->where($fieldName, $fieldValue)->get();
    }
}
