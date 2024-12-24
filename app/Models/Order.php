<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends BaseModel
{
    protected $table = 'orders';

    protected $fillable = [
      'order_date',
      'status'
    ];

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }
}
