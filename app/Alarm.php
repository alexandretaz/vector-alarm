<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable=['client_id','opened_at', 'closed_at', 'interactions','points'];

    public function client()
    {
        return $this->belongsTo('App\Clients');
    }

    public function getInteractionsAttribute()
    {
        return \json_decode($this->attributes['interactions']);
    }

    public function getPointsAttribute()
    {
        return \json_decode($this->attributes['points']);
    }



}
