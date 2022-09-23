<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
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
            'location_id' => 'required',
            'item_id' => 'required',
            'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'location_id.required' => 'Es obligatorio seleccionar uba obligacion',
            'item_id.required' => 'Es obligatorio seleccionar uba obligacion',
            'value.required' => 'Es obligatorio asignar un valor'
        ];
    }
}
