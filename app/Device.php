<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function client()
    {
        return $this->belongsTo('App\Clients','owner_id');
    }
}
