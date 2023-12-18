<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => 'required|integer|exists:clients,id',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }
}

