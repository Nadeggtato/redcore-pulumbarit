<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'id' => [
                'required',
                'exists:roles,id',
            ],
            'name' => [
                'required',
                'unique:roles,name,' . request()->input('id'),
                'max:255',
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'permissions.*' => [
                'exists:permissions,name',
            ],
        ];
    }
}
