<?php

namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContractController extends Controller
{


    public function index()
    {

        $contracts = Contract::select()->paginate();

        return view('contract.list', ['contracts'=>$contracts]);

    }

    public function add()
    {
        $contract = new Contract();
        return view('contract.form', ['contract'=> $contract]);
    }

    public function edit($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        return view ('contract.form', ['contract'=>$contract]);
    }

    public function store(Request $request)
    {
        $requestId = $request->input('id', null);
        $data = $request->toArray();
        unset($data['_token']);
        if(empty($requestId)) {
            Contract::create($data);

        }
        else{
            $contract = Contract::findOrFail($requestId);
            $contract->client_name = $data['client_name'];
            $contract->client_alias = $data['client_alias'];
            $contract->number_of_connections = $data['number_of_connections'];
            $contract->save();
        }
        return redirect()->route('contracts');
    }

    public function delete($contractId)
    {
        $contract = Contract::findOrFail($contractId);
        $contract->delete();
        return redirect()->route('contracts');
    }

    private function getFilters()
    {
        return Input::get();

    }



}
