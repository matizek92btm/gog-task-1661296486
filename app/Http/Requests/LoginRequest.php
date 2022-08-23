<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.attributes.email' => ['required', 'string'],
            'data.attributes.password' => ['required', 'string'],
        ];
    }
}
