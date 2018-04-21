<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $appends = ['client'];
    public function client()
    {
        return $this->belongsTo('App\Clients','owner_id');
    }
}
