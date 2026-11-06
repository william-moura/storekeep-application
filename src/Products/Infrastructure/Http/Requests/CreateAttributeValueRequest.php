<?php

namespace Src\Products\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttributeValueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'attribute_id' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ];
    }
}