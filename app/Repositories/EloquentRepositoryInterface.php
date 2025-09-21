<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    public function all(): Collection;

    public function allWithPaginate($paginate = 30, $type = 'DESC');

    public function allWithRelation(array $relations);

    public function findWithRelation(int $id, array $relations);

    public function find(int $id): ?Model;

    public function status(int $id): bool;
    public function where($key, $value, $orWhere = null);

    public function create(array $attributes): Model;

    public function update(int $id, array $attributes): bool;

    public function delete(int $id): bool|null;
}
