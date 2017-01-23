<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App;
use \GuzzleHttp\Exception\GuzzleException;
use \GuzzleHttp\Client;
use \SMSGateway;
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
    public function phonearenajson(Request $request,$terms){
        $client = new Client();
        $res = $client->request('GET', 'http://www.phonearena.com/search', [
            'query' => ['terms'=> $terms]
        ]);
        return $res->getBody();
    }
    public function phonearenaimg(Request $request, $term){
        $client = new Client();
        $res = $client->request('GET', 'http://www.phonearena.com/search', [
            'query' => ['term'=> $term]
        ]);
        return $res->getBody();
    }
    public function phonearena(Request $request, $term){
        $client = new Client();
        $res = $client->request('GET', 'http://www.phonearena.com/search', [
            'query' => ['term'=> $term]
        ]);
        return $res->getBody();
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
    public function repairs(Request $request){
        if ($request->ajax()){
            $repairs = App\Repair::all();
            foreach($repairs as $repair){
                $repair->person();
                $repair->device();
            }
            if (!$repairs->isEmpty()){
                return $repairs;
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
    public function sendSMSRepairStatus($id,Request $request)
    {
        if ($request->ajax()){
            try{
                $repair = App\Repair::where(['id'=>$id])->firstOrFail();
                $person = $repair->person;
                $device = $repair->device;
                $deviceID = 36788;
                $number = '+39'.$person->telefono;
                $message = 'Smartbit la informa sullo stato attuale della sua riparazione: '."\n\n".'-stato →'.$repair->stato.".\n".'-dispositivo →'.$device->model.".\n\n".'Buona giornata da Smartbit!'."🤖";
                $options = [
                'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
                'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
                ];
                $sms_sb = SMSGateway::sendMessageToNumber($number,$message,$deviceID);
                return $sms_sb;
            }catch(ModelNotFoundException $ex){
                return $ex;
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