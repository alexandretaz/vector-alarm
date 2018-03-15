<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;

class CarController extends Controller
{
    public function add($clientId)
    {
        $client = Clients::findOrFail($clientId);
        $cars = $client->veiculo;
        return view('clients.veiculos_form',['client'=>$client]);
    }

    public function edit($clientId, $position)
    {
        $client = Clients::findOrFail($clientId);
        return view('clients.veiculos_form',['client'=>$client, 'car'=>$position]);
    }

    public function store(Request $request)
    {
        $clientId = $request->input('client_id');
        $client = Clients::findOrFail($clientId);
        $cars = $client->veiculo;
        $data = $request->toArray();
        unset($data['_token']);
        $veic = new \stdClass();
        $veic->placa = $data['placa'];
        $veic->modelo = $data['modelo'];
        $veic->ano = $data['ano'];
        $veic->cor = $data['cor'];
        $veic->grau = $data['grau'];
        $veic->marca= $data['marca'];
        if(isset($data['car_position'])) {
            $cars[$data['car_position']] = $veic;
        }
        else{
            $cars[] = $veic;
        }
        $client->veiculo = \json_encode($cars);
        $client->save();
        return redirect("/client/{$clientId}");

    }

    public function delete($clientId, $position)
    {
        $client = Clients::findOrFail($clientId);
        $arrVeiculo = $client->veiculo;
        unset($arrVeiculo[$position]);
        $veiculo = json_encode($arrVeiculo);
        $client->veiculo = $veiculo;
        $client->save();
        return redirect("/client/{$clientId}");
    }
}
