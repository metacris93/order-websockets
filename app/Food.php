<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'food';
    public function order()
    {
        return $this->hasOne('App\Order', 'food_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id', 'id');
    }
}
