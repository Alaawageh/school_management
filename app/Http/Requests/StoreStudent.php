<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudent extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required',
            'name_en' => 'required',
            'email' => 'required|unique:students,email,'.$this->id,
            'password' => 'required|string|min:6',
            'birth_date' => 'required|date',
            'gender_id' => 'required',
            'nationality_id' => 'required',
            'blood_id' => 'required',
            'religion_id' => 'required',
            'grade_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'parent_id' => 'required',
            'academic_year' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'birth_date.required' => trans('validation.required'),
            'gender_id.required' => trans('validation.required'),
            'nationality_id.required' => trans('validation.required'),
            'blood_id.required' => trans('validation.required'),
            'grade_id.required' => trans('validation.required'),
            'class_id.required' => trans('validation.required'),
            'section_id.required' => trans('validation.required'),
            'parent_id.required' => trans('validation.required'),
            'academic_year.required' => trans('validation.required'),
        ];
    }
}
