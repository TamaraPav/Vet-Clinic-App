<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "emailLog" => "required|email",
            "passwordLog" => [ "required", "regex:/^[a-z0-9]{6,20}$/" ]
        ];
    }

    public function messages(){
        return [
            "required" => "Field :attribute error."
        ];
    }
}
