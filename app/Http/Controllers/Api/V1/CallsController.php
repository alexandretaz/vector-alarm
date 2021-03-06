<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 21/04/18
 * Time: 10:07
 */

namespace App\Http\Controllers\Api\V1;

use App\Alarm;
use App\Clients;
use App\User;
use App\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CallsController extends Controller
{
        public function getCalls($maxAlarmCall=null, $maxHelpCall=null){
            $openAlarms = Alarm::getOpen();
            $openHelps = Help::getOpen();
            if($lastAlarm = $openAlarms->first()) {
                $lastAlarm = $openAlarms->first()->id;
            }
            else{
                $lastAlarm = 0;
            }
            if( $lastHelp = $openHelps->first())
            {
                $lastHelp = $openHelps->first()->id;
            }
            else{
                $lastHelp = 0;
            }

            $lastAlarms = [];
            $lastHelps = [];
            if($maxAlarmCall!==null && $maxHelpCall !==null){
                $lastAlarms = $this->getNewAlarms($maxAlarmCall);
                $lastHelps = $this->getNewHelps($maxHelpCall);
            }

            $answer = new \stdClass();
            $answer->openCalls = $openAlarms->count()+$openHelps->count();
            $answer->lastHelp = $lastHelp;
            $answer->lastAlarm = $lastAlarm;
            $answer->lastHelps = $lastHelps;
            $answer->lastAlarms = $lastAlarms;
            $answer->lastCalls = count($lastHelps)+count($lastAlarms);
            return response()->json($answer);
        }

        private function getNewAlarms($lastAlarmCall) {
            return Alarm::query()->select('id')->where('id','>',(int)$lastAlarmCall)->get()->toArray();
        }

        private function getNewHelps($lastHelpCall) {
            return Help::query()->select('id')->where('id','>',(int)$lastHelpCall)->get()->toArray();

        }
}