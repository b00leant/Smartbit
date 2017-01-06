<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessionController extends Controller
{
    public function checkSessionForRepair(Request $request){
        if(!$request->session()->has('select-person')){
            return true;
        }
    } 
}
