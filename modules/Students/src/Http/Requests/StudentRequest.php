<?php

namespace Modules\Students\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route()->student;

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' =>'required|min:6',
            'status' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value==0) {
                    $fail(__('student::validation.select'));
                }
            }],
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:students,email,'.$id;
            if ($this->password) {
                $rules['password'] ='min:6';
            } else {
                unset($rules['password']);
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('student::validation.required'),
            'email' => __('student::validation.email'),
            'unique' => __('student::validation.unique'),
            'min' => __('student::validation.min'),
            'integer' => __('student::validation.integer')
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('student::validation.attributes.name'),
            'email' => __('student::validation.attributes.email'),
            'password' => __('student::validation.attributes.password'),
            'status' => __('student::validation.attributes.status'),
        ];
    }
}