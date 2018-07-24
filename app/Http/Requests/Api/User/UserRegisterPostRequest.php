<?php

namespace App\Http\Requests\Api\User;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterPostRequest extends FormRequest
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
            'organizations_id' => 'required|exists:organizations,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Field :attribute is required',
            'email.email' => 'Field :attribute is undefined type',
            'email.unique' => 'User with this email address is exist',
            'password.required' => 'Field :attribute is required',
            'password.confirmed' => 'Field :attribute is not confirmed',
            'password.min' => 'Field password must have :min or more symbols',
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationFailedException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->messages() as $key => $val) {
            $error = [];
            foreach ($val as $item) {
                $error['code'] = 1;
                $error['target'] = $key;
                $error['message'] = $item;
                $errors[] = $error;
            }
        }
        throw new ValidationFailedException(1, 'Validation error', $errors, 200);
    }
}
