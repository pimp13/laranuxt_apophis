<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:4', 'max:65'],
            'slug' => ['required', 'string', 'min:4', 'max:45', 'unique:articles,slug'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,svg,webp,ico,gif', 'max:1024'],
            'summary' => ['required', 'string', 'min:4'],
            'body ' => ['required', 'string', 'min:4'],
        ];
    }
}
