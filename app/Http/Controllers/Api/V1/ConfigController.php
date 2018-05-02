<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 02/05/18
 * Time: 05:46
 */

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Configs;

class ConfigController extends Controller
{
    public function get()
    {
        return Configs::query()->select()->whereNull('client_id')->orderBy('id','desc')->first();

    }

    public function getByClient($client_id)
    {
        return Configs::query()->select()->where('client_id','=', $client_id)->orderBy('id','desc')->first();

    }
}