<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLibroRequest extends FormRequest{
    public function authorize():bool{
        return true;
    }

    public function rules():array{
        $rules = [
            'titulo' => [
                'required',
                'string',
                'max:150',
                Rule::unique('libros')->where(function ($query) {
                    return $query->where('autor_id', request('autor_id'));
                })
            ],
            'codigo' => 'required|string|max:10',
            'autor_id' => 'required|exists:autors,id',
        ];
        return $rules;
    }
}