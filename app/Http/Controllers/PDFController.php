<?php

namespace App\Http\Controllers;

use PDF;
use DNS1D;
use DNS2D;
use Illuminate\Http\Request;
use App;
use View;
use App\Http\Requests;

class PDFController extends Controller
{
    //
    public function ricevuta($id){
        $repair = App\Repair::find($id);
        $repair->person();
        $repair->device();
        $barcode64 = DNS1D::getBarcodePNG($repair->seriale, "C128");
        $view = View::make('ricevuta')->with(['barcode64'=>$barcode64,'repair'=>$repair]);
        return PDF::loadHTML($view->render())->stream('Ricevuta.pdf');
    }
    public function ddt($id){
        $delivery = App\Delivery::find($id);
        if($delivery->stato =='creata'){
            $delivery->repairs();
            $delivery->stato = 'spedita';
            $delivery->save();
            $repairs = $delivery->repairs;
            $delivery->technicalSupport();
            $view = View::make('ddt')->with(['repairs'=>$repairs,'delivery'=>$delivery]);
            return PDF::loadHTML($view->render())->stream('Ricevuta.pdf');
        }else{
            return redirect('/#del');
        }
    }
    public function ddtPickup($id){
        $delivery = App\Delivery::find($id);
        if($delivery->stato =='da_ritirare'){
            $delivery->repairs();
            $delivery->stato = 'ritirato';
            $delivery->save();
            $repairs = $delivery->repairs;
            $delivery->technicalSupport();
            $view = View::make('ddtPickup')->with(['repairs'=>$repairs,'delivery'=>$delivery]);
            return PDF::loadHTML($view->render())->stream('Ricevuta.pdf');
        }else{
            return redirect('/#del');
        }
    }
}
