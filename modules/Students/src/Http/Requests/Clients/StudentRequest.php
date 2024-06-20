<?php

namespace Modules\Students\src\Http\Requests\Clients;

use Illuminate\Support\Facades\Auth;
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
        $id = Auth::guard('students')->user()->id;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'required|regex:/(0)[0-9]{9}/',
            'address' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => __('students::validation.required'),
            'email' => __('students::validation.email'),
            'unique' => __('students::validation.unique'),
            'min' => __('students::validation.min'),
            'phone.regex' => __('students::validation.phone-invalid'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('students::validation.attributes.name'),
            'email' => __('students::validation.attributes.email'),
            'password' => __('students::validation.attributes.password'),
            'phone' => __('students::validation.attributes.phone'),
            'address' => __('students::validation.attributes.address'),
        ];
    }
}
