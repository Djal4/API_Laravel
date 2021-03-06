<?php

namespace App\Http\Requests\Intern;

use Illuminate\Foundation\Http\FormRequest;

class InternStoreRequest extends FormRequest
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
            'name' => 'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'city' => 'sometimes|required',
            'number'=>'sometimes|required|numeric|min:8'
        ];
    }
}
//            'cv'=>'required|mimetypes:application/pdf|max:10000'

