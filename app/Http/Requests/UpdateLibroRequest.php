<?php
namespace App\Http\Requests;
use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class UpdateLibroRequest extends StoreLibroRequest{
    public function authorize():bool{
        return true;
    }

    public function rules():array{

        $rules = parent::rules();

        $rules['titulo'] = [
            'required',
            'string',
            'max:100',
            Rule::unique('libros')
                ->where(fn($query) => $query->where('autor_id', $this->input('autor_id')))
                ->ignore($this->route('libro')),
        ];
        return $rules;
    }
}