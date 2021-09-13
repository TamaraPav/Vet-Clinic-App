<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "firstName" => [ "required", "regex:/^[A-Z][a-z]{2,20}$/" ],
            "lastName" => [ "required", "regex:/^[A-Z][a-z]{2,20}$/" ],
            "telephone" => [ "required", "regex:/^[0-9]$/" ],
            "address" => [ "required", "regex:/^[a-zA-Z0-9\s,.]{3,}$/" ],
            "email" => "required|email",
            "password" => [ "required", "regex:/^[a-z0-9]{6,20}$/" ],
            "repPass" => [ "required", "regex:/^[a-z0-9]{6,20}$/" ]
        ];
    }

    public function messages(){
        return [
            "required" => "Field :attribute error."
        ];
    }
}
