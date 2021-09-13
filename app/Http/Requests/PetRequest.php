<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            "petName" => 'required|max:30',
            'image'=> 'required|image|max:2000',
            "bloodType" => 'required|max:3',
            "dob" => 'date|before:today',
            'allergies' => 'nullable|string'
        ];
    }

    public function messages(){
        return [
            "required" => "Field :attribute error.",
            'petName.max' => 'Name must not be longer than :max characters.',
            'image.image' => 'Uploaded file must be an image.',
            'image.max' => 'Uploaded file must not be larger than :max kilobytes.'
        ];
    }
}
