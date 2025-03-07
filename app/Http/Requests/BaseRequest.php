<?php

namespace App\Http\Requests;

use App\Utils\ResponseUtil;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
          response()->json(
            ResponseUtil::sendError('Validation errors.', $validator->errors()->toArray()), Response::HTTP_BAD_REQUEST)
        );
    }
}