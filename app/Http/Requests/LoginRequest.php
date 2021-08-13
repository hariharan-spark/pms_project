<?php

namespace App\Http\Requests;

use App\Helpers\JsonRequestInterface;


class LoginRequest extends JsonRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|
                     min:3',
            'email'=>'required|
                      unique:users',
            'password'=>'required|
                         min:8|',
            'date_of_birth' => '',
            'gender'=> '',
            'phone_number' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'team' => '',
            'roles' => ''
        ];
    }
}
