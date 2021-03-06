<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "cf-email" => "required|email",
            "cf-name" => [ "required", "regex:/^[A-Z][a-z]{2,20}$/" ],
            "cf-message" => "required|min:3|max:1000",
            "cf-subject" => "required|min:3|max:100"
        ];
    }

    public function messages(){
        return [
            "required" => "Field :attribute error."
        ];
    }
}
