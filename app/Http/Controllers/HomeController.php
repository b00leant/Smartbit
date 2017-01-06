<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }
    public function home()
    {
        if(Auth::check()){
            $deliveries = App\Delivery::all();
            foreach($deliveries as $delivery){
                $delivery->technicalSupport();
                $delivery->repairs();
            }
            $repairs_pagination = App\Repair::where('stato','!=','ritirata')->orderBy('id', 'desc')->paginate(10);
            foreach($repairs_pagination as $repair){
                $repair->device();
                $repair->person();
            }
            $repairs = App\Repair::all();
            $length = sizeof($repairs);
            $links = array();
            for($i = 0; $i < $length; $i++){
                $repairs[$i]['owner'] = $repairs[$i]->person_name();
            }
            $people = App\Person::all();
            $people_pagination = App\Person::orderBy('id', 'desc')->paginate(6);
            return View::make('welcome')->with(['people_pages'=>$people_pagination,
                'repairs_pages'=>$repairs_pagination,
                'repairs' =>$repairs,
                'deliveries'=>$deliveries,
                'people' =>$people]);
        }
        return View::make('home');
    }
}
