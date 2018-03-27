<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 07/03/18
 * Time: 04:25
 */

namespace App\Http\Controllers\Api\V1;

use App\Clients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function start(Request $request) {
        $user = Clients::getByDevice($request->input('device'), $request->input('token'));
        if($user!==null) {
            $help = Help::createFomClient($user);
        }
        return \response()->json($help);
    }

    public function point(Request $request) {
        $help = Help::findOrFail($request->input('help_id'));
        $help->addPoint($request->input('latitude'), $request->input('longitude'));
        return response()->json($help);
    }

    public function assume(Request $request) {
        $help = Help::findOrFail($request->input('help_id'));;
        return response()->json($help);
    }

    public function interact(Request $request) {
        $help = Help::findOrFail($request->input('help_id'));
        $help->addInteraction($request->input('interaction'));
        return response()->json($help);
    }

    public function close(Request $request)
    {
        $help = null;
        return response()->json($help);
    }


}