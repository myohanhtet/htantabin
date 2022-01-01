<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        if(request()->password){

            $rule = [
                'name'      => 'required|max:255',
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($this->user)
                ],
                'email'     => [
                    'email',
                    'required',
                    Rule::unique('users')->ignore($this->user)
                ],
                'password'  => 'required|confirmed|min:6',
                'role'      => 'required|max:255',
            ];
        } else {
            $rule = [
                'name'      => 'required|max:255',
                'role'      => 'required|max:255',
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($this->user)
                ],
                'email'     => [
                    'email',
                    'required',
                    Rule::unique('users')->ignore($this->user)
                ]

            ];
        }
        return $rule;
    }
}
