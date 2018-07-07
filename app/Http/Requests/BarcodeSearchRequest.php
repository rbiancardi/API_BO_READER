<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarcodeSearchRequest extends FormRequest
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

          'barcode' => 'min:4|numeric|required',
          'daterange'  => 'required'
            //
        ];
    }

    public function messages(){


      return [ 'barcode.min' => 'El codigo de barras debe contener al menos 4 numeros',
               'barcode.numeric' => 'El codigo de barras solo debe contener numeros',
               'barcode.required' => 'El codigo de barras es obligatorio para esta busqueda',
               'datarange.required' => 'El rango de Fecha es obligatorio para esta busqueda'
      ];
    }
}
