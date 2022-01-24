<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Food extends Model
{
    use Notifiable;
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
    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'order.broadcast.'.$this->admin_id;
    }
}
