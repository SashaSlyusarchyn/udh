<?php

namespace App\Http\Requests\Api\User;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserStorePostRequest extends FormRequest
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
            'departments_id' => 'required|exists:departments,id',
            'secret_levels_id' => 'required|exists:secret_levels,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'active' => 'required|boolean',
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
