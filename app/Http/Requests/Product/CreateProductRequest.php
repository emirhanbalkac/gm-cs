<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateProductRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'name'       => ['required', 'string'],
          'unit_price' => ['required', 'numeric'],
          'vat'        => ['nullable', 'numeric'],
          'discount'   => ['nullable', 'numeric']
        ];
    }
}
