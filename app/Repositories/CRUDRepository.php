<?php

namespace App\Repositories;

use App\Repositories\Contracts\CRUDRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CRUDRepository implements CRUDRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function get(int $id): Model
    {
        return $this->model->find($id);
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes): Model
    {
        $model = $this->model->find($id);
        $model->update($attributes);

        return $model->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete($id);
    }
}
