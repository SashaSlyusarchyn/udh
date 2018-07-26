<?php

namespace App\Http\Requests\Api\File;

use App\Exceptions\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FileSharePostRequest extends FormRequest
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
            'organizations_id' => 'exists:organizations,id',
            'departments_id' => 'exists:departments,id',
            'user_email' => 'exists:users,email',
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
