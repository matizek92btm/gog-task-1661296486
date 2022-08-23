<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckUniqueCart implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        return ! User::find($value['id'])->cart;
    }

    public function message()
    {
        return trans('validation.cart_exist');
    }
}
