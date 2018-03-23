<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->toArray();
        $input = $data['0'];
        $objInput = \json_decode($input);
        $cpf = $objInput->cpf;
        $code = $objInput->code;
        $deviceImei = $objInput->imei;
        $deviceBrand = $objInput->brand;
        $deviceModel = $objInput->model;
        if(empty($cpf) || empty($code) || empty($deviceImei) ) {
             \header('Dados necessários ausentes',true,404);
             die('Xurupita');

        }
        else{
            $client = Client::select()->where('code', $code)->first();
            var_dump($client->toArray());
            die();
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
