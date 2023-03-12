<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'users_name' => 'required',
            'users_email' => 'required',
            'users_post' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'users_name.required' => "Please, write your name!",
            'users_email.required' => "Please, write your email!",
            'users_post.required' => "Please, write your position in company!",
        ];
    }
}
