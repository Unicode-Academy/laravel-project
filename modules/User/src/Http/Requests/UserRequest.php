<?php

namespace Modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route()->user;

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' =>'required|min:6',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value==0) {
                    $fail(__('user::validation.select'));
                }
            }],
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:users,email,'.$id;
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
            'required' => __('user::validation.required'),
            'email' => __('user::validation.email'),
            'unique' => __('user::validation.unique'),
            'min' => __('user::validation.min'),
            'integer' => __('user::validation.integer')
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('user::validation.attributes.name'),
            'email' => __('user::validation.attributes.email'),
            'password' => __('user::validation.attributes.password'),
            'group_id' => __('user::validation.attributes.group_id'),
        ];
    }
}