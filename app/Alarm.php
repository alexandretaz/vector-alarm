<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable =['client_id','opened_at', 'closed_at', 'interactions','points'];

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
        if(!is_array($points)) {
            $points = [];
        }
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
        if(empty($interactions))
        {
            $interactions = [];
        }
        else{
            if(is_object($interactions)){
                $firstInteraction = clone $interactions;
                unset($interactions);
                $interactions = [];
                $interactions[] = $firstInteraction;
            }
        }
        $interaction = new \stdClass();
        $interaction->title = $message;
        $interaction->type = $type;
        $interaction->datetime = $actualDate->format('d/m/Y H:i:s');
        $interactions[] = $interaction;
        $this->attributes['interactions'] = \json_encode($interaction);
        $this->save();
    }

    public static function createFromClient($client, $latitude=null, $longitude=null)
    {
        $openAlarms = self::query()->select()->where('client_id','=', $client->id)->whereNull('closed_at')->get();
        $now = new \DateTime();
        if(!$openAlarms->isEmpty()){

        }
        $points=[];
        if( !empty($latitude) &&!empty($longitude) ) {
            $objPoints = new \stdClass();

            $objPoints->latitude = $latitude;
            $objPoints->longitude = $longitude;
            $points[] = $objPoints;
        }

        $alarm = new Alarm();
        $alarm->client_id = $client->id;
        $alarm->opened_at = $now->format('Y-m-d H:i:s');
        $alarm->description="Alarme aberto pelo aplicativo";
        $alarm->points = \json_encode($points);
        $alarm->save();
        return $alarm;
    }

    public static function getByDeviceToken($token, $imei)
    {

    }





}
