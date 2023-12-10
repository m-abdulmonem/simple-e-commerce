<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
class BaseApiRequest extends FormRequest
{

    /**
     * Get the error messages for the defined validation rules.*
     * @param Validator $validator
     * @return JsonResponse
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): JsonResponse
    {
        $response = [
            'errors' => $validator->errors(),
            'status' => false,
            'data' => null,
            'msg' => $validator->errors()->first()
        ];

        throw new ValidationException($validator, response($response, 422));
    }
}
