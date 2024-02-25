<?php

namespace Modules\Lessons\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
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
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'parent_id' => 'required|integer',
            'is_trial' => 'required|integer',
            'position' => 'required|integer',
            'video' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('lessons::validation.required'),
            'email' => __('lessons::validation.email'),
            'integer' => __('lessons::validation.integer')
        ];
    }

    public function attributes()
    {
        return __('lessons::validation.attributes');
    }
}
