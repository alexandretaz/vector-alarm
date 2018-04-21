<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 11/04/18
 * Time: 10:10
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Redis;



class ChatController extends Controller
{

    public function sendMessage(Request $request){
        $redis = Redis::connect();

        $request->toArray();
    }

}