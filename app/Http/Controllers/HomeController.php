<?php

namespace App\Http\Controllers;

use App\Alarm;
use App\Help;
use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class HomeController extends Controller
{


    public function index()
    {
       $points = $this->getPoints();

        return view('home', ['points'=>$points]);
    }




    protected function getPoints($size=null)
    {
        $alarms = Alarm::getOpen();
        $helps = Help::getOpen();
        $points = [];

        if(!empty($alarms) ) {
            foreach ($alarms as $alarm) {
                if(isset($alarm->points) && !empty($alarm->points)) {
                    $actionPoints = $alarm->points;

                    $pointToAdd = end($actionPoints);
                    $points [] = $pointToAdd;
                }
            }
        }
        if(!empty($points)) {
            foreach ($helps as $help) {
                if(isset($help->points) && !empty($help->points)) {
                    $actionPoints = $alarm->points;
                    $pointToAdd = end($actionPoints);
                    $points [] = $pointToAdd;
                }
            }
        }
        if($size!==null && !isset($actionPoints["$size"])) {
            return[];
        }

        unset($actionPoints, $pointToAdd);

        return $points;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

}
