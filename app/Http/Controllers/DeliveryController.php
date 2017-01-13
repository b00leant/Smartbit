<?php

namespace App\Http\Controllers;

use App;
use View;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeliveryController extends Controller
{
    public function home(){
        return View::make('deliveries');
    }
    public function selectTechnicalSupport(){
        $tech_sups = App\TechnicalSupport::all();
        return View::make('new-delivery-step1')->with(['tech_sups'=>$tech_sups]);
    }
    public function selectTechnicalSupportPickup(){
        $tech_sups = App\TechnicalSupport::all();
        return View::make('new-pickup-step1')->with(['tech_sups'=>$tech_sups]);
    }
    public function createPickup(Request $request){
        if($request->has('center')){
            try{
                $delivery = new App\Delivery([
                'stato'=>'da_ritirare'
                ]);
                $tech_sup = App\TechnicalSupport::find($request->input('center'));
                $tech_sup->deliveries()->save($delivery);
                return redirect('/delivery/'.$delivery->id);
            }catch(ModelNotFoundException $ex){
                return redirect('/');
            }
        }else{
            return back()->withInput();
        }
    }
    public function selectDeliveries(Request $request){
        if($request->has('center')){
            $repairs_to_send = App\Repair::where(['assistenza'=>true])
            ->where('stato','!=','finita')
            ->where('stato','!=','consegnata')->get();
            foreach($repairs_to_send as $repair){
                $repair->device();
                $repair->person();
                $repair->person_name();
            }
            return View::make('new-delivery-step2')->with(['repairs'=>$repairs_to_send,
            'center'=>$request->input('center')]);
        }else{
            return redirect('/#del');
            //return back()->withInput();
        }
    }
    public function selectDate(Request $request){
        if($request->has('center') and $request->has('json_repairs')){
            if($request->input('json_repairs')!='' or $request->input('json_repairs')!=null){
            //dovrei controllare il json??
            try{
                $center = App\TechnicalSupport::where(['id'=>$request->input('center')])->firstOrFail();
            }catch(ModelNotFoundException $ex){
                $center = '???';
            }
            $repairs_new_delivery;
            $json_repairs = json_decode($request->input('json_repairs'));
            foreach($json_repairs as $repair){
                $repair1 = App\Repair::find($repair);
                $repairs_new_delivery[$repair] = $repair1;
            }
            $repairs_new_delivery = json_encode($repairs_new_delivery);
            return View::make('new-delivery-step3')->with(['repairs'=>$repairs_new_delivery,'old_repairs'=>$request->input('json_repairs'),
            'centerobj'=>$center,'center'=>$request->input('center')]);
            }else{
                return redirect('/new-delivery');
                //return back()->withInput();
            }
        }else{
            return back()->withInput();
        }
    }
    public function handleCreate(Request $request){
        if($request->has('center') and $request->has('json_repairs') and $request->has('date_delivery')){
            
            $date = date_create_from_format('Y-m-d', $request->input('date_delivery'));
            
            try{
                $delivery = new App\Delivery([
                'stato'=>'creata',
                'task_consegna'=>$date
                ]);
                //$delivery->technicalSupport()->save($tech_sup);
                //$tech_sup->deliveries()->save($delivery);
                $tech_sup = App\TechnicalSupport::find($request->input('center'));
                //where(['id'=>$request->input('center')])->firstOrFail();
                $tech_sup->deliveries()->save($delivery);
                $repairs_idz = json_decode($request->input('json_repairs'));
                foreach($repairs_idz as $id){
                    $repair = App\Repair::find($id);
                    //where(['id'=>$id])->firstOrFail();
                    $repair->delivery()->associate($delivery);
                    $repair->save();
                    //$repair->delivery()->save($delivery);
                }
                return redirect('/#del');
            }catch(ModelNotFoundException $ex){
                return redirect('/');
            }
        }else{
            return back()->withInput();
        }
    }
    public function handleDelete($id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $repairs = App\Repair::where(['delivery_id'=>$id]);
            foreach($repairs as $repair){
                $repair->delivery()->dissociate();
            }
            $delivery->technicalSupport()->dissociate();
            $delivery->delete();
            return redirect('/#del');
        }catch (ModelNotFoundException $ex) {
                // Error handling code
                return redirect('/');//->action('PeopleConteoller@createToUse');
                //return View::make('checktest')->with('nomecompleto','AIAH, MI SA CHE HAI FATTO IL FURBETTO');
        }
    }
    public function show($id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $delivery->repairs();
            $repairs_to_send = App\Repair::where(['assistenza'=>true])
            ->where('stato','!=','finita')
            ->where('stato','!=','consegnata')->get();
            foreach($repairs_to_send as $repair){
                $repair->device();
                $repair->person();
                $repair->person_name();
            }
            foreach($delivery->repairs() as $repair){
                $repair->device();
            }
            $tech_sups = App\TechnicalSupport::all();
            $delivery->technicalSupport();
            return View::make('delivery')->with([
                'repairs'=>$repairs_to_send,
                'tech_sups'=>$tech_sups,
                'delivery'=>$delivery]);
        }catch(ModelNotFoundException $ex){
            return redirect('/#del');
        }
    }
    public function update(Request $request, $id){
        if($request->ajax()){
            try{
                $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
                $delivery->technicalSupport()->dissociate();
                $date = date_create_from_format('Y-m-d', $request['date']);
                $delivery->task_consegna = $date;
                $center_req = $request['centers_update'];
                $repairs = App\Repair::where(['delivery_id'=>$id])->get();
                foreach($repairs as $repair){
                    $repair->delivery()->dissociate();
                    $repair->save();
                }
                $repairs_to_update = $request['repairs_update'];
                foreach($repairs_to_update as $key => $value){
                    $repair_new = App\Repair::find($key);
                    $repair_new->delivery()->associate($delivery);
                    $repair_new->save();
                }
                if($center_req['id']!=null){
                    $center_id = $center_req['id'];
                    $tech_sup = App\TechnicalSupport::find($center_id);
                    $tech_sup->deliveries()->save($delivery);
                }
                
                $res = ['richiesta'=>$request,'id_ricevuto'=>$id,'repairz'=>$repairs];
                return $res;
            }catch(ModelNotFoundException $ex){
                return $response;
            }
        }else{
            return $response;
        }
    }
    public function updatePickup(Request $request, $id){
        if($request->ajax()){
            try{
                
                $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
                $center_req = $delivery->technicalSupport;
                $delivery->technicalSupport()->dissociate();
                $date = date_create_from_format('Y-m-d', $request['date']);
                $delivery->task_ritiro = $date;
                $repairs = App\Repair::where(['delivery_id'=>$id])->get();
                foreach($repairs as $repair){
                    $repair->delivery()->dissociate();
                    $repair->save();
                }
                $repairs_to_update = $request['repairs_update'];
                foreach($repairs_to_update as $key => $value){
                    $repair_new = App\Repair::find($key);
                    $repair_new->delivery()->associate($delivery);
                    $repair_new->save();
                }
                if($center_req['id']!=null){
                    $center_id = $center_req['id'];
                    $tech_sup = App\TechnicalSupport::find($center_id);
                    $tech_sup->deliveries()->save($delivery);
                }
                
                $res = ['richiesta'=>$request,'id_ricevuto'=>$id,'repairz'=>$repairs];
                return $res;
            }catch(ModelNotFoundException $ex){
                return $response;
            }
        }else{
            return $response;
        }
    }
    //
}


/*public function show(Request $request, $id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $delivery->repairs();
            foreach($delivery->repairs() as $repair){
                $repair->device();
            }
            $delivery->technicalSupport();
            return View::make('delivery')->with(['delivery'=>$delivery]);
        }catch(ModelNotFoundException $ex){
            return redirect('/#del');
        }
    }*/