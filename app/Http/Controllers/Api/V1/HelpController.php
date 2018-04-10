<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 07/03/18
 * Time: 04:25
 */

namespace App\Http\Controllers\Api\V1;

use App\Clients;
use App\Help;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
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

                $help = Help::createFomClient($user);
            }
            else{
                $help = Help::createFromClient($user, $latitude, $longitude);
            }

            $help->points;
            return response(\json_encode($help),200);
        }

        return response(\json_encode(false),500);
    }

    public function point(Request $request) {
        $data = $request->toArray();
        $jsonStr = key($data);
        $jsonObject = \json_decode($jsonStr);

        $imei = $jsonObject->imei;
        $token = $jsonObject->token;
        $latitude = str_replace("_",".",$jsonObject->latitude);
        $longitude = str_replace("_",".",$jsonObject->longitude);
        $user = Clients::getByDevice($imei, $token);
        $help = $user->openHelps();

        if($latitude!=0 && $longitude!=0) {
            $help->addPoint($latitude, $longitude);
        }

        return response(\json_encode($help),200);
    }

    public function assume(Request $request) {
        $help = Help::findOrFail($request->input('help_id'));;
        return response()->json($help);
    }

    public function interact(Request $request) {
        $help = Help::findOrFail($request->input('help_id'));
        $help->addInteraction($request->input('interaction'));
        return response()->json($help);
    }

    public function close(Request $request)
    {
        $help = null;
        return response()->json($help);
    }


}