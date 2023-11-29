<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'quantity' => 'required|integer',
            'price' => 'required|decimal:10,2',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}

