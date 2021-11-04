<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'lastname' => 'sometimes|required',
            'skype'=> 'sometimes|required',
            'roles_id'=> 'sometimes|required',
            'password'=>'sometimes|required|min:8',
            'group_id'=>'sometimes|required'
        ];
    }
}
