<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "firstName" => "regex:/^[A-Z][a-z]{2,20}$/" ,
            "lastName" => "regex:/^[A-Z][a-z]{2,20}$/" ,
            "telephone" => "regex:/^[0-9]$/" ,
            "address" => "regex:/^[a-zA-Z0-9\s,.]{3,}$/",
            "email" => "email"
        ];
    }

    public function messages(){
        return [

        ];
    }
}
