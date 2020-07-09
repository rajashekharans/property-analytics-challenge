<?php

namespace App\Repositories;

use App\Models\PropertyAnalytic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PropertyAnalyticRepository extends BaseRepository implements PropertyAnalyticRepositoryInterface
{
    public function __construct(PropertyAnalytic $model)
    {
        parent::__construct($model);
    }

    public function updateOrCreate(array $attributes): Model
    {
        $updateResult = $this->model
            ->where('property_id', $attributes['property_id'])
            ->where('analytic_type_id', $attributes['analytic_type_id'])
            ->update(['value' => $attributes['value']]);

        if($updateResult) {
            return $this->model
                    ->where('property_id', $attributes['property_id'])
                    ->where('analytic_type_id', $attributes['analytic_type_id'])
                    ->get()
                    ->first();
        }
        return $this->model->create($attributes);
    }

    public function getAnalytics(array $propertyIdArray, int $type_id): Collection
    {
        return $this->model
            ->whereIn('property_id', $propertyIdArray)
            ->where('analytic_type_id', $type_id)
            ->get();
    }
}
