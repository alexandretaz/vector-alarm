<?php

namespace App\Http\Controllers;

use App\Configs;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    public function show($id=1) {
        $config = Configs::find($id);
        if(empty($config)) {
            $config = new Configs();
            $config->save();
        }
        return view('configs.form',['config'=>$config]);
    }

    public function update(Request $request) {
        $id = $request->input('id', 1);
        $config = Configs::find($id);
        if(empty($config)) {
            $config = new Configs();
            $config->save();
        }
        $config->client_id = $request->input('client_id',null);
        $config->start_panic = $request->input('start_panic',null);
        $config->start_help = $request->input('start_help',null);
        $config->update_panic = $request->input('update_panic',null);
        $config->update_help = $request->input('update_help', null);
        $config->tell_to_call = $request->input('tell_to_call', "+551136489340");
        $config->save();

        return redirect()->to('/config');
    }
}
