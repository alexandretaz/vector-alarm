<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $cpf = $request->input('cpf');
        $code = $request->input('code');
        $device = $request->input('device');

        if(empty($cpf) || empty($code) || empty($device) ) {
            return reponse(404)->json(false);
        }
        else{
            $client = Client::select()->where('cpf', $cpf)->get();
            $client->addDevice($device);
        }

        return response(200)->json($client);

    }

}
