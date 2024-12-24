<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends BaseModel
{
    protected $table = 'invoices';

    protected $fillable = [
      'order_id',
      'invoice_date',
      'grand_total'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
