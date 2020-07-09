<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PropertyAnalyticRepositoryInterface
{
    public function updateOrCreate(array $attributes): Model;
    public function getAnalytics(array $propertyIds, int $type_id): Collection;
}
