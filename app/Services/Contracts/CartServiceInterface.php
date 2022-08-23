<?php

namespace App\Services\Contracts;

use App\Models\Cart;
use App\Models\User;

interface CartServiceInterface
{
    public function create(User $user): Cart;
}
