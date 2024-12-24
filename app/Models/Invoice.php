<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class, 'order_id', 'order_id');
    }
}
