<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartRepository extends CRUDRepository implements CartRepositoryInterface
{
    public function create(array $attributes): Model
    {
        $makeModel = $this->model->make();
        $makeModel->user()->associate($attributes['user']);
        $makeModel->save();

        return $makeModel;
    }
}
