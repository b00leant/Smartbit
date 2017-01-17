<?php

namespace App\Http\Controllers;

use App;
use View;
use SMSGateway;
use Carbon;
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
                $date = Carbon\Carbon::today();
                $delivery = new App\Delivery([
                'stato'=>'da_ritirare',
                'task_ritiro'=>$date
                ]);
                $tech_sup = App\TechnicalSupport::find($request->input('center'));
                $tech_sup->deliveries()->save($delivery);
                return redirect('/delivery/'.$delivery->id);
            }catch(ModelNotFoundException $ex){
                return redirect('/home');
            }
        }else{
            return back()->withInput();
        }
    }
    public function selectDeliveries(Request $request){
        if($request->has('center')){
            $repairs_to_send = App\Repair::where(['assistenza'=>true])
            ->where('stato','!=','finita')
            ->where('stato','!=','consegnata')
            ->where('stato','!=','in_lista_per_centro')
            ->where('stato','!=','in_assistenza')
            ->where('delivery_id','=',null)->get();
            foreach($repairs_to_send as $repair){
                $repair->device();
                $repair->person();
                $repair->person_name();
            }
            return View::make('new-delivery-step2')->with(['repairs'=>$repairs_to_send,
            'center'=>$request->input('center')]);
        }else{
            return redirect('/home#del');
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
    //gestito la creazione di due spedizioni nello stesso posto, stessa data
    public function handleCreate(Request $request){
        if($request->has('center') and $request->has('json_repairs') and $request->has('date_delivery')){
            
            $date = date_create_from_format('Y-m-d', $request->input('date_delivery'));
            try{
                $delivery_check = App\Delivery::where('task_consegna','=',$date)->first();
                if($delivery_check){
                    $tech_sup_check = $delivery_check->technicalSupport;
                $tech_sup_check2 = App\TechnicalSupport::where(['id'=>$request->input('center')])->first();
                if($delivery_check and $tech_sup_check->id === $tech_sup_check2->id){
                    $repairs_idz = json_decode($request->input('json_repairs'));
                    foreach($repairs_idz as $id){
                        $repair = App\Repair::find($id);
                        //where(['id'=>$id])->firstOrFail();
                        $repair->delivery()->associate($delivery_check);
                        $repair->stato = 'in_lista_per_centro';
                        $repair->save();
                        //$repair->delivery()->save($delivery);
                        //return redirect('/delivery/'.$delivery_check->id)->with('error', 'È già stata programmata una spedizione per quel giorno, nello stesso centro!');
                    }
                    return redirect('/home#del');
                }else{
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
                            $repair->stato = 'in_lista_per_centro';
                            $repair->save();
                            //$repair->delivery()->save($delivery);
                        }
                        return redirect('/home#del');
                }
                }else{
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
                            $repair->stato = 'in_lista_per_centro';
                            $repair->save();
                            //$repair->delivery()->save($delivery);
                        }
                        return redirect('/home#del');
                }
                
            }catch(ModelNotFoundException $ex){
                    return redirect('/home');
                }
        }else{
            return back()->withInput();
        }
    }
    public function handleDelete($id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $repairs = App\Repair::where(['delivery_id'=>$id])->get();
            foreach($repairs as $repair){
                $repair->delivery()->dissociate();
                $repair->stato = 'iniziata';
                $repair->save();
            }
            $delivery->technicalSupport()->dissociate();
            $delivery->delete();
            return redirect('/home#del');
        }catch (ModelNotFoundException $ex) {
                // Error handling code
                return redirect('/home');//->action('PeopleConteoller@createToUse');
                //return View::make('checktest')->with('nomecompleto','AIAH, MI SA CHE HAI FATTO IL FURBETTO');
        }
    }
    public function show($id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $delivery->repairs();
            $repairs_to_send = App\Repair::where(['assistenza'=>true])
            ->where('stato','!=','finita')
            ->where('stato','!=','consegnata')
            ->where('stato','!=','in_lista_per_centro')
            ->where('delivery_id','=',null)->get();
            $repairs_to_pickup = App\Repair::where(['assistenza'=>true])
            ->where('stato','=','in_assistenza')
            ->where('stato','!=','in_lista_per_centro')
            ->where('delivery_id','=',null)
            ->where('technical_support_id','=',''.$delivery->technicalSupport->id)->get();
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
                'repairs_to_send'=>$repairs_to_send,
                'repairs_to_pickup'=>$repairs_to_pickup,
                'tech_sups'=>$tech_sups,
                'delivery'=>$delivery]);
        }catch(ModelNotFoundException $ex){
            return redirect('/home#del');
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
                    $repair->stato = 'creata';
                    $repair->save();
                }
                $repairs_to_update = $request['repairs_update'];
                foreach($repairs_to_update as $key => $value){
                    $repair_new = App\Repair::find($key);
                    $repair_new->delivery()->associate($delivery);
                    $repair->stato = 'in_lista_per_centro';
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
    public function ddt($id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $delivery->stato = 'spedita';
            $delivery->save();
            $tech_sup = $delivery->technicalSupport;
            foreach($delivery->repairs as $repair){
                $repair->delivery()->dissociate();
                $repair->stato = 'in_assistenza';
                $repair->save();
                $tech_sup->repairs()->save($repair);
                $tech_sup->save();
                app('App\Http\Controllers\SMSContoller')->sendDeliverySMS($repair->id);
            }
            $delivery->delete();
            return redirect('/home#del');
        }catch(ModelNotFoundException $ex){
            return redirect('/home#del');
        }
    }
    public function ddtPickup($id){
        try{
            $delivery = App\Delivery::where(['id'=>$id])->firstOrFail();
            $delivery->stato = 'ritirata';
            $delivery->save();
            $tech_sup = $delivery->technicalSupport;
            $repairs = $delivery->repairs;
            foreach($delivery->repairs as $repair){
                $repair->delivery()->dissociate();
                $repair->technicalSupport()->dissociate();
                $repair->stato = 'ritirata_dal_centro_assistenza';
                $repair->save();
                app('App\Http\Controllers\SMSContoller')->sendPickupSMS($repair->id,$tech_sup->id);
            }
            $delivery->delete();
            return redirect('/home#del');
        }catch(ModelNotFoundException $ex){
            return redirect('/home#del');
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
            return redirect('/home#del');
        }
    }*/