<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Contracts\CRUDServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CRUDService implements CRUDServiceInterface
{
    public function __construct(private Model $model)
    {
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $attributes): Product
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes): Product
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
