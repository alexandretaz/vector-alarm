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
        $client->contract_id=$contractId;
        return view('clients.form',['client'=>$client, 'contract'=>$contract]);
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

    }

    public function delete($clientId)
    {

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
        foreach ($veiculosArr as $veiculo) {
            $carro = new \stdClass();
            $carro->placa = $veiculo['placa'];
            $carro->marca = $veiculo['marca'];
            $carro->modelo = $veiculo['modelo'];
            $carro->ano = $veiculo['ano'];
            $carro->cor = $veiculo['cor'];
            $carro->grau = $veiculo['grau'];
            $carros[] = $carro;
        }
        $prioritarios = [];
        foreach ($cpArr as $priotitario) {
            $contato_prioridade = new \stdClass();
            $contato_prioridade->nome = $priotitario['nome'];
            $contato_prioridade->parentesco_grau = $priotitario['parentesco_grau'];
            $contato_prioridade->tel_com = $priotitario['tel_com'];
            $contato_prioridade->tel_cel = $priotitario['tel_cel'];
            $contato_prioridade->tel_res = $priotitario['tel_res'];
            $contato_prioridade->email = $priotitario['email'];
            $prioritarios[] = $contato_prioridade;
        }
        $autorizados = [];
        foreach ($caArr as $autorizado) {
            $contato_autorizado = new \stdClass();
            $contato_autorizado->nome = $autorizado['nome'];
            $contato_autorizado->parentesco_grau = $autorizado['parentesco_grau'];
            $contato_autorizado->tel_com = $autorizado['tel_com'];
            $contato_autorizado->tel_cel = $autorizado['tel_cel'];
            $contato_autorizado->tel_res = $autorizado['tel_res'];
            $contato_autorizado->email = $autorizado['email'];
            $autorizados[] = $contato_autorizado;
        }

        unset($data['client']['veiculo'], $data['client']['contatos_prioridade'], $data['client']['contatos_autorizados']);
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
        $client->rg = $data['rg'];
        $client->tel_res = $data['tel_res'];
        $client->tel_com = $data['tel_com'];
        $client->tel_cel = $data['tel_celular'];
        $client->senha = $data['senha'];
        $client->contrasenha = $data['contrasenha'];
        $client->procedimentos_especiais = $data['procedimentos_especiais'];
        if(isset($data['client'])) {
            $client->veiculo = \json_encode($carros);
            $client->contatos_prioridade = \json_encode($prioritarios);
            $client->contatos_autorizados = \json_encode($autorizados);
        }
        else{
            $client->parent_client = $data['parent_client'];
        }
        $client->save();

        return redirect('/contract/'.$client->contract_id.'/clients');

    }

}
