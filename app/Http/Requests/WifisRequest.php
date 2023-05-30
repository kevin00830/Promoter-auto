<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WifisRequest extends FormRequest
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
            'mac_wan' => 'required',
            'mac_lan' => 'required',
            'bssid' => 'required',
            'nasid' => 'required|integer',
            'channel' => 'required',
            'city' => 'required',
        ];
    }
}
