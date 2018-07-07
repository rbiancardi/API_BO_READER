<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReaderSearchRequest extends FormRequest
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
            'daterange'  => 'max:41|required'
            //
        ];
    }


    public function messages(){


      return [ 'daterange.required' => 'El rango de fecha no debe quedar vacio',
               'datarange.max' => 'Por Favor, verifique el formato del rango que fecha coincida con el siguiente
                formato AAAA-MM-DD HH:MM:SS A AAAA-MM-DD HH:MM:SS'
      ];
    }


}
