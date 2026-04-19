<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function query()
    {
        return $this->model->query();
    }

    public function all()
    {
        return $this->model->orderBy('id','DESC')->get();
    }

    public function allWithPaginate($paginate = 5, $type = 'DESC')
    {
        $paginateCount = count($this->model->all()) / 5;
        $items = $this->model->orderBy('id', $type)->paginate($paginate);
         return response()->json([$paginateCount, $items]);
    }

    public function allWithRelation(array $relations)
    {
        $paginateCount = count($this->model->all()) / 5;
        $items = $this->model->with($relations)->orderBy('id','DESC')->paginate(5);
        return response()->json([$paginateCount, $items]);
    }

    public function findWithRelation(int $id, array $relations)
    {
        return $this->find($id)?->load($relations);
    }

    public function find(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function status(int $id):bool
    {
        $model = $this->find($id);
        $model->status = !$model->status;
        return $model->save();

    }

    public function where($key, $value, $orWhere = null)
    {
        if ($orWhere) {
            return $this->model->where($key, $value)->orWhere($orWhere, $value)->get();
        }else {
            return $this->model->where($key, $value)->get();
        }
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->find($id)->update($attributes);
    }

    public function delete(int $id): bool|null
    {
        return $this->find($id)->delete();
    }
}
