<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
