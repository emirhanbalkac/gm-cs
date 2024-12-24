<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
          response()->json([
                             'success' => false,
                             'message' => 'The given data was invalid.',
                             'errors'  => $validator->errors()
                           ])
        );
    }
}