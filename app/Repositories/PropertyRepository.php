<?php

namespace App\Repositories;

use App\Models\Property;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Property $model
     */
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Model
     */
    public function create(array $attributes): Model
    {
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
