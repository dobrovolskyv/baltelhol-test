<?php

namespace App\Http\Requests\Api\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price'=> 'required|numeric:min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
