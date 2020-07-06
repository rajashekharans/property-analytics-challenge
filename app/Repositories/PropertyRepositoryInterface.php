<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PropertyRepositoryInterface
{
    public function create(array $attributes): Model;
    public function all(): Collection;
}
