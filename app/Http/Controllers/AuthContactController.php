<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;

class AuthContactController extends Controller
{
    public function add($clientId)
    {
        $client = Clients::findOrFail($clientId);
        $cars = $client->veiculo;
        return view('clients.contatos_autorizados',['client'=>$client]);
    }

    public function edit($clientId, $position)
    {
        $client = Clients::findOrFail($clientId);
        return view('clients.contatos_autorizados',['client'=>$client, 'contato'=>$position]);
    }

    public function store(Request $request)
    {

        $clientId = $request->input('client_id');
        $client = Clients::findOrFail($clientId);
        $cas = $client->contatos_autorizados;
        $data = $request->toArray();
        if(!is_array($cas)) {
            $cas =[];
        }
        unset($data['_token']);
        $contatos_autorizados = new \stdClass();
        $contatos_autorizados->nome = $data['nome'];
        $contatos_autorizados->parentesco_grau = $data['parentesco_grau'];
        $contatos_autorizados->tel_com = $data['tel_com'];
        $contatos_autorizados->tel_cel = $data['tel_cel'];
        $contatos_autorizados->tel_res = $data['tel_res'];
        $contatos_autorizados->email= $data['email'];
        if(isset($data['position'])) {
            $cas[$data['position']] = $contatos_autorizados;
        }
        else{
            $cas[] = $contatos_autorizados;
        }
        $client->contatos_autorizados = \json_encode($cas);
        $client->save();
        return redirect("/client/{$clientId}");

    }

    public function delete($clientId, $position)
    {
        $client = Clients::findOrFail($clientId);
        $arrAutorizados = $client->contatos_autorizados;
        unset($arrAutorizados[$position]);
        $contatos_autorizados = json_encode($arrAutorizados);
        $client->contatos_autorizados = $contatos_autorizados;
        $client->save();
        return redirect("/client/{$clientId}");
    }

}
