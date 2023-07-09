<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'List_Classes.*.name' => 'required',
            'List_Classes.*.name_en' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
        ];
    }
   
}
