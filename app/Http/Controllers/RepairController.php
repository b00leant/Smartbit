<?php

namespace App\Http\Controllers;

use View;
use App\Http\Requests;
use Illuminate\Http\Request;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;

class RepairController extends Controller
{
    public function info(Request $request)
    {
        if($request->ajax()){
            //$id = $request->input('id');
            $id = $request['id'];
            try{
                $repair = App\Repair::where(['id'=>$id])->firstOrFail();
                $person = $repair->person;
                $devie = $repair->device;
                return $repair;
            }catch(ModelNotFoundException $ex){
                return 'nothing was found';
            }
            
        }
    }
    public function index(Request $request)
    {
        //return View::make('home');
        if($request->ajax()){
            $index = $request->input('index');
            $repairs = App\Repair::where('stato','!=','ritirata')->orderBy('id', 'desc')->paginate(10);
            return $repairs;
        }else{
            $response = array(['success' => 'false','errors'=>'non si trova'],400);
            return $response;
        }
        //return View::make('index');
    }
    public function create()
    {
        return View::make('create');
    }
    public function checkOwner(Request $request)
    {
        if($request->has('nomecompleto') and $request->has('nome') and $request->has('cognome') and $request->has('id')
        and $request->input('nome') !='' and $request->input('cognome') !='' and $request->input('id')!=''){
            $id = $request->input('id');
            $nome = $request->input('nome');
            $cognome = $request->input('cognome');
            $match = ['id'=>$id,'nome'=>$nome,'cognome'=>$cognome];
            try{
                $result = App\Person::where($match)->firstOrFail()->get();
                if (!$result->isEmpty()){
                    $data = array(
                        'nome'=>$nome,
                        'cognome'=>$cognome,
                        'id'=>$id,
                        'nomecompletoback'=>$nome.' '.$cognome
                        );
                    $person = json_encode($data);
                    $request->session()->put('selected-person', $person);
                    return redirect('/select-repair-device');/*->withCookie(
                        'selected-person',
                        $person,
                        '60',
                        '/select-repair-device',
                        'http://smartbit-undeclinable.c9users.io');*/
                    //return View::make('new-repair')->with($data);
                }
            }catch (ModelNotFoundException $ex) {
                // Error handling code
                return redirect('add-person');//->action('PeopleConteoller@createToUse');
                //return View::make('checktest')->with('nomecompleto','AIAH, MI SA CHE HAI FATTO IL FURBETTO');
            }
        }else{
            return redirect('add-person');
            //return redirect()->action('RepairController@selectOwnerForm');
        }
    }
    public function selectDeviceForm(Request $request){
        //if($request->cookie('selected-person'))
        if($request->session()->has('selected-person')){
            //$person = $request->cookie('selected-person');
            $person = $request->session()->get('selected-person');
            $data = json_decode($person);
            //$request->session()->pull('selected-person');
            //$request->session()->reflash('selected-person');
            return View::make('new-repair')->with(['data'=>$data]);
        }else{
            return View::make('expired');
        }
    }
    
    public function selectOwnerForm(Request $request)
    {
        
        return View::make('select-repair-owner');
    }
    public function ajax(Request $request)
    {
        if ($request->input('type') === 'repair'){
            return App\Repair::all();
        }if ($request->ajax() and $request->input('type') === 'person'){
            $people = App\Person::where('nome','like','%'.$request->input('tofind').'%')->get();
            if (!$people->isEmpty()){
                return $people;
                //return response()->json($people);
            }else{
                $response = array(['success' => 'false','errors'=>'non si trova'],400);
                
                return $response;
            }
        }
    }
    public function handleCreate(Request $request)
    {
        if($request->session()->has('selected-person')){
            $session_person = $request->session()->get('selected-person');
            $request->session()->pull('selected-person');
            if($request->has('imei') and $request->has('brand') and $request->has('model')
            and $request->has('model') and $request->has('id-own') and $request->has('description')){
                $assistenza = false;
                $garanzia  = false;
                if($request->has('assistenza')){
                    if($request->input('assistenza')==='true'){
                        $assistenza = true;
                    }else{
                        $assistenza = false;
                    }
                }
                if($request->has('garanzia')){
                    if($request->input('garanzia')==='true'){
                        $garanzia = true;
                    }else{
                        $garanzia = false;
                    }
                }
                $random_string = app('App\Http\Controllers\RandomStringController')->make();
                $repair_existing_serial = App\Repair::where(['seriale'=>$random_string])->first();
                while(count($repair_existing_serial)){
                    $random_string = app('App\Http\Controllers\RandomStringController')->make();
                    $repair_existing_serial = App\Repair::where(['seriale'=>$random_string])->first();
                }
                $today = Carbon::today();
                $device = new App\Device([
                    'imei' => $request->input('imei'),
                    'brand'=> $request->input('brand'),
                    'model'=> $request->input('model')
                    ]);
                $repair = new App\Repair([
                    'stato'=>'creata',
                    'creazione'=>$today,
                    'seriale' => $random_string,
                    'note' => $request->input('description'),
                    'garanzia' => $garanzia,
                    'assistenza' => $assistenza
                    ]);
                //$repair->save();
                $owner_id = $request->input('id-own');
                $owner = App\Person::find($owner_id);
                $owner->repairs()->save($repair);
                $repair->device()->save($device);
                $id =$repair->id;
                //$repair->device()->save($device);
                //return redirect()->route('/repairview', $repair->id);
                //return redirect()->action(
                //    'RepairController@showRepair', ['id' => $repair->id]);
                //return redirect()->route('repairview', ['id' => $repair->id]);
                return redirect('repair/'.$id);
            }else{
                $request->session()->put('selected-person',$session_person);
                return back()->withInput();
                //return redirect('select-repair-owner');
            }
        }else{
            return View::make('expired');
        }
    }
    public function showRepair($id)
    {
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();//->get();
            $person = $repair->person;
            $device = $repair->device;
            return View::make('repair')->with(['repair'=>$repair,'device'=>$device,'person'=>$person]);
        }catch (ModelNotFoundException $ex) {
            // Error handling code
            //return redirect('add-person')->with(['repair'=>$repair,'person'=>$person]);
        }
    }
    public function laboratory(Repair $repair)
    {
        return View::make('laboratory');
    }
    public function handledelete($id)
    {
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            if($repair->delivery_id === null){
                $repair->person()->dissociate();
                $repair->delete();
            }else{
                $repair->delivery()->dissociate();
                $repair->person()->dissociate();
                $repair->delete();
            }
            return redirect('/');
        }catch (ModelNotFoundException $ex) {
                // Error handling code
                return redirect('/');//->action('PeopleConteoller@createToUse');
                //return View::make('checktest')->with('nomecompleto','AIAH, MI SA CHE HAI FATTO IL FURBETTO');
        }
    }
    public function giveback($id){
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            $repair->stato = 'consegnata';
            $repair->save();
            return redirect('/#rip');
        }catch(ModelNotFoundException $ex){
            return redirect('/#rip');
        }
    }
    /*public function delete()
    {
        return View::make('delete');
    }*/
}
