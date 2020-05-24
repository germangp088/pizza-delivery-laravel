<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public function currency() {
        return $this->belongsTo('App\Currency','id_currency');
    }
}
