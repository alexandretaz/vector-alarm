<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $fillable=['client_id','opened_at', 'closed_at', 'interaction','points'];

    public function client()
    {
        return $this->belongsTo('App\Clients');
    }
    public function getInteractionsAttribute()
    {
        return \json_decode('interactions');
    }

    public function getPointsAttribute()
    {
        return \json_decode('attributes');
    }
}
