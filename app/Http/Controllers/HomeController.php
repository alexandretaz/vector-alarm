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

    public function points()
    {
        return response()->json($this->getPoints());
    }


    private function getPoints()
    {
        $alarms = Alarm::getOpen();
        $helps = Help::getOpen();
        $points = [];
        if(!empty($alarms) ) {
            foreach ($alarms as $alarm) {
                if(isset($alarm->points) && !empty($alarm->points)) {
                    dd($alarm->points);
                    $pointToAdd = end($alarm->points);
                    $points [] = $pointToAdd;
                }
            }
        }
        if(!empty($points)) {
            foreach ($helps as $help) {
                if(isset($alarm->points) && !empty($alarm->points)) {
                    $pointToAdd = end($help->points);
                    $points [] = $pointToAdd;
                }
            }
        }
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
