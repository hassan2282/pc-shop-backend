<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    public function all();

    public function query();

    public function allWithPaginate($paginate = 5, $type = 'DESC');

    public function allWithRelation(array $relations);

    public function findWithRelation(int $id, array $relations);

    public function find(int $id): ?Model;

    public function status(int $id): bool;
    public function where($key, $value, $orWhere = null);

    public function create(array $attributes): Model;

    public function update(int $id, array $attributes): bool;

    public function delete(int $id): bool|null;
}
