<?php

namespace Src\Products\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'skus' => 'required|array',
            'skus.*.sku_code' => 'required|string|max:255',
            'skus.*.ean' => 'required|string|max:255',
            'skus.*.price' => 'required|numeric',
            'skus.*.stock' => 'required|integer',
            // 'skus.*.image' => 'required|string|max:255',
            'skus.*.attribute_values' => 'required|array',
            'skus.*.attribute_values.*' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório',
            'name.string' => 'O nome do produto deve ser uma string',
            'name.max' => 'O nome do produto deve ter no máximo 255 caracteres',
        ];
    }
}