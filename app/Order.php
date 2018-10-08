<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\OrderCreated;

class Order extends Model
{
    protected $fillable = ['user_id', 'comment', 'total', 'customerName', 'customerLastName', 'customerEmail',
        'customerPhone', 'customerAddress'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => OrderCreated::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
