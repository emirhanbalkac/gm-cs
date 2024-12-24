<?php

namespace App\Models;

class Invoice extends BaseModel
{
    protected $table = 'invoices';

    protected $fillable = [
      'order_id',
      'invoice_date',
      'grand_total'
    ];
}
