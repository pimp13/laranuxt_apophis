<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:70|min:4',
            'description' => 'required|string|max:160|min:4',
            'is_active' => 'nullable|in:0,1|boolean|numeric',
            'slug' => 'required|unique:article_categories,slug|string|max:50|min:4'
        ];
    }
}
