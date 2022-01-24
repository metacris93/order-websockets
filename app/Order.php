<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $guarded = [];
    const ORDER_PLACED = 'order_placed';
    public function food()
    {
        return $this->belongsTo('App\Food', 'food_id', 'id');
    }
    public function buyer()
    {
        return $this->belongsTo('App\User', 'buyer_id', 'id');
    }
}
