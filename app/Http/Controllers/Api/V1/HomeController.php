<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\HomeController as CoreHomeController;

class HomeController extends CoreHomeController
{


    public function points($size)
    {
        return response()->json($this->getPoints());
    }
    public function __construct()
    {
        $this->middleware('api');
    }


}
