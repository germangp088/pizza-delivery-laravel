<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer() {
        return $this->belongsTo('App\Customer','id_customer');
    }
    public function bill() {
        return $this->belongsTo('App\Bill','id_bill');
    }
}
