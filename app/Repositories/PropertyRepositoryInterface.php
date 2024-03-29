<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PropertyRepositoryInterface
{
    public function create(array $attributes): Model;
    public function findPropertyAnalyticsByPropertyId(int $propertyId): Collection;
    public function findPropertyByFieldName(string $fieldName, string $fieldValue): Collection;
}
