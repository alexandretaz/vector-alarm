<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ClientController extends Controller
{
    public function index($contractId)
    {
        $clients = Clients::select()->where('contract_id', '=', (int)$contractId)->whereNull('parent_client')->paginate();
        $contract = Contract::findOrFail($contractId);

        return view('clients.list', ['clients' => $clients, 'contract' => $contract]);
    }

    public function search($contractId)
    {
        $strSearch = Input::get('serch');
        $clients = Clients::where('contract_id', '=', (int)$contractId)->whereNull('parent_client')->where('name', 'like', '%'.$strSearch.'%')->paginate();
        $contract = Contract::findOrFail($contractId);

        return view('clients.list', ['clients' => $clients, 'contract' => $contract]);
    }

    public function add($contractId)
    {
        $client = new Clients();
        $contract = Contract::findOrFail($contractId);
        $client->contract_id=$contractId;
        return view('clients.form',['client'=>$client, 'contract'=>$contract]);
    }

    public function show($clientId){
        $client = Clients::findOrFail($clientId);
        return view ('clients.show', ['client'=>$client]);
    }

    public function showDependents($parent_id) {

    }

    public function addDependent($clientId)
    {
        $client = new Clients();
        $parentClient = Clients::findOrFail($clientId);
        $client->parent_client = $parentClient->id;
        $client->contract_id = $parentClient->contract_id;
        $contract = $client->contract;
        return view('clients.form',['client'=>$client, 'contract'=>$contract]);
    }

    public function edit($clientId)
    {
        $client = Clients::findOrFail($clientId);
        $contract = Contract::findOrFail($client->contract_id);
        return view('clients.form',['client'=>$client, 'contract'=>$contract]);
    }

    public function delete($clientId)
    {
        $client = Clients::findOrFail($clientId);
        foreach($client->dependents as $dependent)
        {
            $dependent->delete();
        }
        $client->delete();
        return redirect('/contract/'.$client->contract_id.'/clients');
    }

    public function store(Request $request)
    {

        $data = $request->toArray();
        unset($data['_token']);
        if (isset($data['client'])) {

        $veiculosArr = $data['client']['veiculo'];
        $cpArr = $data['client']['contatos_prioridade'];
        $caArr = $data['client']['contatos_autorizados'];
        $carros = [];
        }
        if(isset($data['id']) && !empty($data['id'])) {
            $client = Clients::findOrFail($data['id']);
        }
        else{
            $client = new Clients();
        }

        $client->name = $data['name'];
        $client->contract_id = $data['contract_id'];
        $client->cpf = $data['cpf'];
        $client->code = $data['code'];
        $client->rg = $data['rg'];
        $client->tel_res = $data['tel_res'];
        $client->tel_com = $data['tel_com'];
        $client->tel_cel = $data['tel_celular'];
        $client->senha = $data['senha'];
        $client->contrasenha = $data['contrasenha'];
        $client->procedimentos_especiais = $data['procedimentos_especiais'];
        if(!isset($data['parent_client'])) {
            $client->save();
        }
        else{
            $client->parent_client = $data['parent_client'];
            $client->save();
            $parentClient=$client->parent_client_executive;
            $dependents = $parentClient->dependents->count();
            $client->position = ++$dependents;
            $client->save();

        }



        return redirect('/contract/'.$client->contract_id.'/clients');

    }

}
