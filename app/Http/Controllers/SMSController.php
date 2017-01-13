<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \SMSGateway;
use App\Http\Requests;
use App;

class SMSController extends Controller
{
    public function sendSMSLabStatus($id)
    {
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            $person = $repair->person;
            $device = $repair->device;
            $deviceID = 36788;
            $number = '+39'.$person->telefono;
            switch($repair->stato){
                case 'iniziata':
                    $message = 'Smartbit la informa che la sua riparazione è stata appena iniziata: '."\n\n".'-stato →'.$repair->stato.".\n".'-dispositivo →'.$device->model.".\n\n".'Buona giornata da Smartbit!'."🤖";
                    break;
                case 'finita':
                    $message = 'Smartbit la informa che la sua riparazione è stata appena terminata e a breve potrà essere ritirara: '."\n\n".'-stato →'.$repair->stato.".\n".'-dispositivo →'.$device->model.".\n\n".'Buona giornata da Smartbit!'."🤖";
                    break;
            }
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
    //
}
