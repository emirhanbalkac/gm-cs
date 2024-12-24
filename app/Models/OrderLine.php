<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderLine extends BaseModel
{
    protected $table = 'order_lines';

    protected $fillable = [
      'order_id',
      'product_id',
      'quantity',
      'unit_price',
      'vat',
      'discount'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
