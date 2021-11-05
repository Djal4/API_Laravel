<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
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
            'mark' =>'sometimes|required|numeric',
            'pros' =>'sometimes|required|min:20',
            'cons' =>'sometimes|required|min:20',
            'intern_id'=>'sometimes|required|numeric',
            'mentor_id'=>'sometimes|required|numeric',
            'assignement_id'=>'sometimes|required|numeric'
        ];
    }
}
