<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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

          'price'  => 'required',
          'description' => 'required',
          'agree' => 'accepted'
            //
        ];
    }

    public function messages(){


      return [ 'price.required' => 'El precio debe contener hasta dos decimales y no debe esta en blanco',
               'description.required' => 'El producto debe contener una descripcion',
               'agree.accepted' => 'Debe Aceptar la modificacion requerida'

      ];
    }
}
