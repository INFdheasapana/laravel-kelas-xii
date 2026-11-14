<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFilmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'sinopsis' => 'required|string',
            'year' => 'required|integer',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'genre_id' => 'required|exists:genres,id',
        ];
    }
}
