<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 07/03/18
 * Time: 04:25
 */

namespace App\Http\Controllers\Api\V1;


use App\Alarm;
use App\Clients;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlarmController extends Controller
{

    public function start(Request $request) {
        $data = $request->toArray();
        $jsonStr = key($data);
        $jsonObject = \json_decode($jsonStr);
        $imei = $jsonObject->imei;
        $token = $jsonObject->token;
        $latitude = str_replace("_",".",$jsonObject->latitude);
        $longitude = str_replace("_",".",$jsonObject->longitude);
        $user = Clients::getByDevice($imei, $token);
        if($user!==null) {
            if(empty($latitude) || empty($longitude)) {
                $alarm = Alarm::createFromClient($user);
            }
            else{
                $alarm = Alarm::createFromClient($user, $latitude, $longitude);

            }

            $alarm->points;
            if($latitude!=0 && $longitude!=0) {
                $alarm->addPoint($latitude, $longitude);
            }
            return response(\json_encode($alarm),200);
        }
        return response(\json_encode(false),500);
    }

    public function point(Request $request) {
        $data = $request->toArray();
        file_put_contents("/home/taz/vector-alarm/storage/logs/Api.log", serialize($data),FILE_APPEND);
        $jsonStr = key($data);
        $jsonObject = \json_decode($jsonStr);

        $imei = $jsonObject->imei;
        $token = $jsonObject->token;
        $latitude = (float)$jsonObject->latitude;
        $longitude = (float)$jsonObject->longitude;
        $user = Clients::getByDevice($imei, $token);
        $user->openAlarms();
        var_dump($user->openAlarms()->toArray());
        die();
        return response()->json($alarm);
    }

    public function assume(Request $request) {
        $alarm = Alarm::findOrFail($request->input('alarm_id'));
        return response()->json($alarm);
    }

    public function interact(Request $request) {
        $alarm = Alarm::findOrFail($request->input('alarm_id'));
        $alarm->addInteraction($request->input('interaction'));
        return response()->json($alarm);
    }

    public function close(Request $request)
    {
        $alarm = null;
        return response()->json($alarm);
    }




}