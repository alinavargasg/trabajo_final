<?php
namespace App\Http\Requests;
use App\Http\Requests\StorePrestamoRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestamoRequest extends StorePrestamoRequest{
    public function authorize():bool{
        return true;
    }

    public function rules():array{
        $rules = parent::rules();

        return $rules;
    }
}