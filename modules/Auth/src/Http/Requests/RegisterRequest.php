<?php

namespace Modules\Auth\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('auth::validation.required'),
            'email' => __('auth::validation.email'),
            'unique' => __('auth::validation.email'),
        ];
    }

    public function attributes()
    {
        return __('auth::validation.attributes');
    }

}