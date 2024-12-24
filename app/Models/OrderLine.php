<?php

namespace App\Models;

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
}
