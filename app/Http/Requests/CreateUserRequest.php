<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'unique:users,email',
                'max:255',
            ],
            'role' => [
                'bail',
                'required',
                'exists:roles,id',
            ],
            'password' => [
                'bail',
                'required',
                'min:8',
                'confirmed',
            ],
            'password_confirmation' => [
                'bail',
                'required',
                'same:password',
            ],
        ];
    }
}
