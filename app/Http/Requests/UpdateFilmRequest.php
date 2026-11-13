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
            'poster' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
        ];
    }
}
