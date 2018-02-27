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

    public function store(Request $request)
    {
        $requestId = $request->input('id', null);
        if(empty($requestId)) {
            $data = $request->toArray();
            unset($data['_token']);
            $result = Contract::create($data);
            return redirect()->route('contracts');
        }

    }

    public function delete()
    {

    }

    private function getFilters()
    {
        return Input::get();

    }



}
