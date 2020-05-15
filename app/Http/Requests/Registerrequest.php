<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registerrequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birth' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required|regex:/(0)[0-9]{9}/|unique:users',
        ];
    }
}
