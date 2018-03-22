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

    public function addPoint($lat, $long)
    {
        $points = $this->getPointsAttribute();
        $point = new \stdClass();
        $point->lat = $lat;
        $point->long = $long;
        $points [] = $point;
        $pointJson = \json_encode($points);
        $this->attributes['points'] = $pointJson;
        $this->save();
    }

    public function addInteraction($message, $type=0)
    {
        $actualDate = new \DateTime();
        $interactions = $this->getInteractionsAttribute();
        $interaction = new \stdClass();
        $interaction->title = $message;
        $interaction->type = $type;
        $interaction->datetime = $actualDate->format('d/m/Y H:i:s');
        $interactions[] = $interaction;
        $this->attributes['interactions'] = \json_encode($interaction);
        $this->save();
    }

    public static function createFromClient($client)
    {
        $now = new \DateTime();
        $alarm = new Alarm();
        $alarm->client_id = $client->id;
        $alarm->opened_at = $now->format('Y-m-d H:i:s');
        $alarm->description="Alarme aberto pelo aplicativo";
        $alarm->save();
        return $alarm;
    }





}
