<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ReviewStoreRequest extends FormRequest
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
            'mark' =>'required|numeric',
            'pros' =>'required|min:20',
            'cons' =>'required|min:20',
            'intern_id'=>'required|numeric',
            'mentor_id'=>'required|numeric',
            'assignement_id'=>'required|numeric'
        ];
    }
}
