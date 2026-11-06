<?php

namespace Src\Products\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttributeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}