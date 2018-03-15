<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 07/03/18
 * Time: 04:25
 */

namespace App\Http\Controllers\Api\V1;


use App\Alarm;
use App\User;
use Illuminate\Http\Request;

class AlarmController
{

    public function start(Request $request) {
        $user = User::getByDevice($request->input('device'), $request->input('token'));
        if($user!==null) {
            $alarm = Alarm::create($request);
        }
        return response()->json($alarm);
    }

    public function point(Request $request) {
        $alarm = Alarm::findOrFail($request->input('alarm_id'));
        $alarm->addPoint($request->input('latitude'), $request->input('longitude'));
        return response()->json($alarm);
    }

    public function assume(Request $request) {
        $alarm = Alarm::findOrFail($request->input('alarm_id'));;
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