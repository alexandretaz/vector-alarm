<?php

namespace App\Http\Api\V1\Controllers;

use App\Http\Controllers\HomeController as CoreHomeController;

class HomeController extends CoreHomeController
{


    public function points($size)
    {
        return response()->json($this->getPoints());
    }


}
