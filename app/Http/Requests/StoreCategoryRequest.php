<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|string|min:1|max:255',
        ];
    }

    public function messages(){
        return[
            "name.required" => "La categoria è obbligatoria",
            "name.min" =>  "La categoria deve avere almeno di :min caratteri",
            "name.max" =>  "La categoria deve avere massimo di :max caratteri",
        ];
    }
}