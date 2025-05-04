<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrestamoRequest extends FormRequest{
    public function authorize():bool{
        return true;
    }

    public function rules():array{
        $rules = [
            'fecha_prestamo'=>'required|date',
            'fecha_devolución_programada'=>'required|date|after:fecha_prestamo',
            'fecha_devolución_real'=>'date|after:fecha_prestamo'
        ];
        return $rules;
    }
}