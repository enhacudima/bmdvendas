<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'titulo'=>'required|min:5',
            'cor'=>'required',
            'data_inicio'=>'required|date|after_or_equal:today',
            'data_final'=>'required|date|after_or_equal:data_inicio'
        ];
    }
}
