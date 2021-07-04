<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var User $user */
        $user = auth('web')->user();

        return $user->can('update', User::find(request()->input('id')));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'exists:users,id',
            ],
            'name' => [
                'bail',
                'required',
                'string',
                'unique:users,name,' . request()->input('id'),
                'max:255',
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'unique:users,email,' . request()->input('id'),
                'max:255',
            ],
            'role' => [
                'bail',
                'required',
                'exists:roles,id',
            ],
            'password' => [
                'bail',
                'required_with:password_confirmation',
                'min:8',
                'confirmed',
            ],
            'password_confirmation' => [
                'bail',
                'required_with:password',
                'same:password',
            ],
        ];
    }
}
