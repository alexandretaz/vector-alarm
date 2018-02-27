<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContractController extends Controller
{


    public function index()
    {
        $params = $this->getFilters();
        $this->getRepository()->applyFilters()->get();
    }

    public function add()
    {

    }

    public function store()
    {

    }

    public function delete()
    {

    }

    private function getFilters()
    {
        return Input::get();

    }



}
