<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function people(Request $request)
    {
        if ($request->ajax()){
            $people = App\Person::all();
            //$people = App\Person::where('nome','like','%n%')->get();
            if (!$people->isEmpty()){
                return $people;
                //return response()->json($people);
            }else{
                $response = array(['success' => 'false','errors'=>'non si trova'],400);
                return $response;
            }
        }
    }
    public function searchModels(Request $request)
    {
        if ($request->ajax()){
            if (!$people->isEmpty()){
                return $people;
            }else{
                $response = array(['success' => 'false','errors'=>'non si trova'],400);
                return $response;
            }
        }
    }
    public function sendSMSRepair(Repair $request)
    {
        if ($request->ajax()){
            
            if (!$people->isEmpty()){
                $sms_sb = new SmsGateway('microtel.tre@gmail.com','latini65giovanni');
                $deviceID = 1;
                $number = '+44771232343';
                $message = 'Hello World!';
                $options = [
                'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
                'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
                ];
                $sms_sb->sendMessageToNumber($number,$message,$deviceID,$options);
                return null;
            }else{
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
