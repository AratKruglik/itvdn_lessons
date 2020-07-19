<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'customerName',
        'customerLastName',
        'customerEmail',
        'customerPhone',
        'customerAddress',
        'comment',
        'total',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
