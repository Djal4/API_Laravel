<?php

namespace App\Http\Requests\Intern;

use Illuminate\Foundation\Http\FormRequest;

class InternUpdateRequest extends FormRequest
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
            'name' => 'sometimes|required',
            'lastname'=>'sometimes|required',
            'email'=>'sometimes|required|email',
            'number'=>'sometimes|required|numeric|min:8',
            'city'=> 'sometimes|required',
            'number' => 'sometimes|numeric|required',
            'group_id'=> 'sometimes|required|min:6'
        ];
    }
}
