<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Clients;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->toArray();
        $jsonStr = key($data);
        $json = \json_decode($jsonStr);
        $cpf = $json->cpf;
        $code = $json->code;
        $deviceImei = $json->imei;
        $deviceBrand = $json->brand;
        $deviceModel = $json->model;
        if(empty($cpf) || empty($code) || empty($deviceImei) ) {
             \header('Dados necessários ausentes',true,404);
             die('Xurupita');

        }
        else{
            $client = Clients::select()->where('code', 'like', "$code")->first();

            if($cpf == $client->cpf) {
                $token = sha1($code.$cpf.$deviceImei);
                $client->addDevice($deviceImei, $deviceBrand, $deviceModel, $token);
                $tokenObj = new \stdClass();
                $tokenObj->token = $token;
                return response($token,200);
            }

        }
        return response(\json_encode(false), 404);


    }

}
