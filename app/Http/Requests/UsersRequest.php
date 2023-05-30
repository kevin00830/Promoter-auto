<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
        $rules = [
            'firstname' => 'required',
            'fullname' => 'required',
            'email' => 'required|unique:users',
            'mobile_number' => 'required|unique:users',
            'password' => 'required',
            'dob' => 'required'
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user)
            ];

            $rules['mobile_number'] = [
                'required',
                Rule::unique('users')->ignore($this->user)
            ];

            $rules['password'] = [
                'nullable',
                'confirmed'
            ];
        }

        return $rules;
    }
}
