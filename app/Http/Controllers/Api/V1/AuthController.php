<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $cpf = $request->input('cpf');
        $code = $request->input('code');
        $deviceImei = $request->input('imei');
        $deviceBrand = $request->input('brand');
        $deviceModel = $request->input('model');

        if(empty($cpf) || empty($code) || empty($deviceImei) ) {
            return reponse(404)->json(false);
        }
        else{
            $client = Client::select()->where('code', $code)->get();
            if($cpf == $client->cpf) {
                $token = sha1($code.$cpf.$deviceImei);
                $client->addDevice($deviceImei, $deviceBrand, $deviceModel, $token);
                $tokenObj = new \stdClass();
                $tokenObj->token = $tokenObj;
                return response(200)->json($tokenObj);
            }

        }
        return reponse(404)->json(false);


    }

}
