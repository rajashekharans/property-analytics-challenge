<?php

namespace App\Repositories;

use App\Models\PropertyAnalytic;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class PropertyAnalyticRepository extends BaseRepository implements PropertyAnalyticRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Property $model
     */
    public function __construct(PropertyAnalytic $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Model
     */
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

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}
