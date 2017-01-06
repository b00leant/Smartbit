<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class PDFController extends Controller
{
    //
    public function ricevuta($id){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test: '.$id.'</h1>');
        return $pdf->stream();
    }
}
