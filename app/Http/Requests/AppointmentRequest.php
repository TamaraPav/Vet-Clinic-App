<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            "date" => 'required|date|after:today',
            'time'=> [ "required", "regex:/^[1][0-8]\:[03][0]$/" ],
            "note" => 'nullable|string'
        ];
    }

    public function messages(){
        return [
            "required" => "Field :attribute error.",
            'time' => 'Time must be between 10 and 18:30.'
        ];
    }
}
