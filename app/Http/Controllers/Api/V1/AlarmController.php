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

class AlarmController extends Controller
{

    public function start(Request $request) {
        $data = $request->toArray();
        $jsonStr = key($data);
        $jsonObject = \json_decode($jsonStr);
        var_dump($jsonObject);
        die();
        $imei = $data['imei'];
        $token = $data['token'];
        $user = Clients::getByDevice($imei, $token);
        if($user!==null) {
            $alarm = Alarm::createFromClient($user);
            return response(\json_encode($alarm),200);
        }
        return response(\json_encode(false),500);
    }

    public function point(Request $request) {
        $alarm = Alarm::findOrFail($request->input('alarm_id'));
        $alarm->addPoint($request->input('latitude'), $request->input('longitude'));
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