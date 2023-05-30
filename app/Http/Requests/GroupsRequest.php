<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupsRequest extends FormRequest
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
            'groupname' => 'required',
            'status' => 'required',
            'company' => 'required',
            'wpp_group_id' => 'required',
            'state' => 'required',
            'city' => 'required',
            'district' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'legal_name' => 'required',
            'legal_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];

        if ($this->getMethod() == 'PUT') {
            $rules['email'] = [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->group->users()->whereRole('groupadmin')->first())
            ];

            $rules['password'] = [
                'nullable',
                'confirmed'
            ];
        }

        return $rules;
    }
}
