<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class CreateOrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'order_date'         => ['required', 'date'],
          'lines'              => ['required'],
          'lines.*'            => ['required', 'array', 'min:1'],
          'lines.*.product_id' => ['required', 'integer'],
          'lines.*.quantity'   => ['required', 'integer'],
          'lines.*.unit_price' => ['required', 'numeric'],
          'lines.*.vat'        => ['required', 'numeric'],
          'lines.*.discount'   => ['required', 'numeric'],
        ];
    }
}
