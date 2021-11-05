<?php

namespace App\Http\Requests\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentUpdateRequest extends FormRequest
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
            'title' =>'sometimes|required',
            'description'=>'sometimes|required|min:20',
            'date_assigned'=>'sometimes|required',
            'finish_date'=>'sometimes|required',
            'group_id'=>'sometimes|required|numeric'
        ];
    }
}
