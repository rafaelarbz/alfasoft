<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateContactFormResquest extends FormRequest
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
        $id = $this->id ? $this->id : '';
        $rules = [
            'country_code' => "string|required",
            'number' => [
                'string',                        
                'required',
                'min:9',
                'max:9',
                'regex:/^([0-9\-]*)$/',
                Rule::unique('contacts', 'number')->where(function ($query) { 
                $query->where('number', $this->number)
                ->where('country_code', $this->country_code); 
                })->ignore($id)
            ],
        ];

        return $rules;
    }
}
