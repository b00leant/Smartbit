<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Http\Requests;
use App;

class TechnicalSupportController extends Controller
{
    //
    public function create(){
        return View::make('new-tech-sup');
    }
    public function handleCreate(Request $request){
        if($request->has('nome') and $request->has('addr_complete')
        and $request->has('telefono') and $request->has('marca')){
            $tech_sup = new App\TechnicalSupport([
                    'nome'=>$request->input('nome'),
                    'telefono'=>$request->input('telefono'),
                    'indirizzo'=>$request->input('addr_complete'),
                    'brand'=>$request->input('marca')
                    ]);
            $tech_sup->save();
            return redirect('/');
        }else{
            return back()->withInput();
        }
    }
}
