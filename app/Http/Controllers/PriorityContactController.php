<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;

class PriorityContactController extends Controller
{
    public function add($clientId)
    {
        $client = Clients::findOrFail($clientId);
        return view('clients.contatos_prioridade',['client'=>$client]);
    }

    public function edit($clientId, $position)
    {
        $client = Clients::findOrFail($clientId);
        return view('clients.contatos_prioridade',['client'=>$client, 'cp'=>$position]);
    }

    public function store(Request $request)
    {

        $clientId = $request->input('client_id');
        $client = Clients::findOrFail($clientId);
        $cp = $client->contatos_prioridade;
        $data = $request->toArray();
        if(!is_array($cp)) {
            $cp =[];
        }
        unset($data['_token']);
        $contatos_prioritario = new \stdClass();
        $contatos_prioritario->nome = $data['nome'];
        $contatos_prioritario->parentesco_grau = $data['parentesco_grau'];
        $contatos_prioritario->tel_com = $data['tel_com'];
        $contatos_prioritario->tel_cel = $data['tel_cel'];
        $contatos_prioritario->tel_res = $data['tel_res'];
        $contatos_prioritario->email= $data['email'];
        if(isset($data['position'])) {
            $cp[$data['position']] = $contatos_prioritario;
        }
        else{
            $cp[] = $contatos_prioritario;
        }
        $client->contatos_prioridade = \json_encode($cp);
        $client->save();
        return redirect("/client/{$clientId}");

    }

    public function delete($clientId, $position)
    {
        $client = Clients::findOrFail($clientId);
        $arrAutorizados = $client->contatos_prioridade;
        unset($arrAutorizados[$position]);
        $contatos_autorizados = json_encode($arrAutorizados);
        $client->contatos_prioridade = $contatos_autorizados;
        $client->save();
        return redirect("/client/{$clientId}");
    }
}
