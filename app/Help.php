<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
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

    public static function createFromClient($client, $device, $latitude = null, $longitude = null)
    {

        $openAlarms = self::query()->select()->where('client_id','=', $client->id)->where('device_id','=', $device->id)->whereNull('closed_at')->get();
        $now = new \DateTime();
        if(!$openAlarms->isEmpty()){
            $alarm = $openAlarms->first();
            $points = $alarm->getPointsAttribute();
            if(!is_array($points)) {
                $points=[];
            }
        }
        else{
            $alarm = new Help();
            $points=[];
            $alarm->client_id = $client->id;
            $alarm->opened_at = $now->format('Y-m-d H:i:s');
            $alarm->description="Pedido de ajuda enviado pelo aplicativo";
        }

        if( !empty($latitude) &&!empty($longitude) ) {
            $objPoints = new \stdClass();
            $alarm->device_id = $device->id;
            $objPoints->latitude = $latitude;
            $objPoints->longitude = $longitude;
            $points[] = $objPoints;
        }



        $alarm->points = \json_encode($points);
        $alarm->save();
        return $alarm;
    }

    public static function getOpen(){
        return Help::query()->select()->whereNull('closed_at')->orderBy('id', 'desc')->get();
    }
}
