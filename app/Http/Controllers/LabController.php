<?php

namespace App\Http\Controllers;

use View;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class LabController extends Controller
{
    //
    public function updateNoteLab(Request $request, $id){
        if($request->ajax()){
            try{
                $repair = App\Repair::where(['id'=>$id])->firstOrFail();
                if($repair->stato == 'iniziata'){
                    $repair->note_lab = $request['note_lab'];
                    $repair->save();
                }
                return $repair;
            }catch(ModelNotFoundException $ex){
                return 'error';
            }
        }
    }
    public function changeState(Request $request,$id){
        if($request->ajax()){
            try{
                $repair = App\Repair::where(['id'=>$id])->firstOrFail();
                switch($repair->stato){
                    case 'creata':
                        $repair->stato = 'iniziata';
                        $today = Carbon::today();
                        $repair->inizio = $today;
                        $repair->save();
                        break;
                    case 'iniziata':
                        $repair->stato = 'finita';
                        $today = Carbon::today();
                        $repair->fine = $today;
                        $repair->save();
                        break;
                    /*case 'finita':
                        $repair->stato = 'pronta';
                        $repair->save();
                        break;
                    case 'pronta':
                        $repair->stato = 'ritirata';
                        $today = Carbon::today();
                        $repair->consegna = $today;
                        $repair->save();
                        break;*/
                    default:
                        break;
                }
                return $repair;
            }catch(ModelNotFoundException $ex){
                return 'error';
            }
        }
    }
    
    public function finishLab($id){
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            $repair->stato = 'finita';
            $repair->save();
            return redirect('/lab');
        }catch(ModelNotFoundException $ex){
            return redirect('/lab');
        }
    }
    public function index(Request $request){
        if($request->ajax()){
            $index = $request->input('index');
            $repairs = App\Repair::where('stato','!=','ritirata')->where('stato','!=','finita')->paginate(10);
            return $repairs;
        }else{
            $response = array(['success' => 'false','errors'=>'non si trova'],400);
            return $response;
        }
    }
    
    public function home(){
        if(Auth::user()->id === 1 or Auth::user()->id === 2){
            $repairs = App\Repair::where('stato','!=','pronta')
            ->where('stato','!=','ritirata')->
            where('stato','!=','finita')->where('stato','!=','finita-lab')->paginate(10);
            return View::make('lab')->with(['repairs_pages'=>$repairs]);
        }else{
            return redirect('/');
        }
    }
}
