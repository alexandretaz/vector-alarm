<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Contract;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index($contractId)
    {
        $clients = Clients::select()->where('contract_id', '=', (int)$contractId)->whereNull('parent_client')->paginate();
        $contract = Contract::findOrFail($contractId);

        return view('clients.list', ['clients' => $clients, 'contract' => $contract]);
    }

    public function add($contractId)
    {
        $client = new Clients();
        $contract = Contract::findOrFail($contractId);
        return view('clients.form',['client'=>$client, 'contract'=>$contract]);
    }

    public function addDependent($clientId)
    {
        $client = new Clients();
        $parentClient = Clients::findOrFail($clientId);
        $client->parent_client = $parentClient->id;
        $contract = $client->contract;
        return view('clients.form',['client'=>$client, 'contract'=>$contract]);
    }

    public function edit($clientId)
    {

    }

    public function delete($clientId)
    {

    }

    public function store(Request $request)
    {
        $data = $request->toArray();
        unset($data['_token']);

    }

}
