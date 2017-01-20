<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \SMSGateway;
use App\Http\Requests;
use App;

class SMSController extends Controller
{
    public function sendDeliverySMS($id){
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            $person = $repair->person;
            $device = $repair->device;
            $delivery = $repair->delivery;
            $technical_support = $repair->technicalSupport;
            $deviceID = 36788;
            $number = '+39'.$person->telefono;
            $message = 'Smartbit la informa che la sua riparazione è stata appena spedita presso: '."\n\n".'- '.$technical_support->nome."\n".'- Indirizzo: '.$technical_support->indirizzo.".\n\n".'Buona giornata da Smartbit!'."🤖";
            $options = [
            'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
            'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
            ];
            $sms_sb = SMSGateway::sendMessageToNumber($number,$message,$deviceID);
        }catch(ModelNotFoundException $ex){
            return null;
        }
    }
    public function sendPickupSMS($id,$tec){
        try{
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            $person = $repair->person;
            $device = $repair->device;
            $technical_support =  App\Repair::where(['id'=>$tec])->firstOrFail();
            $deviceID = 36788;
            $number = '+39'.$person->telefono;
            $message = 'Smartbit la informa che la sua riparazione è stata appena ritirata presso: '."\n\n".'- '.$technical_support->nome."\n".'- Indirizzo: '.$technical_support->indirizzo.".\n\n".'Buona giornata da Smartbit!'."🤖";
            $options = [
            'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
            'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
            ];
            $sms_sb = SMSGateway::sendMessageToNumber($number,$message,$deviceID);
        }catch(ModelNotFoundException $ex){
            return null;
        }
    }
    public function sendSMSLabStatus($id)
    {
        try{
            sleep(2);
            $repair = App\Repair::where(['id'=>$id])->firstOrFail();
            $person = $repair->person;
            $device = $repair->device;
            $deviceID = 36788;
            $number = '+39'.$person->telefono;
            switch($repair->stato){
                case 'iniziata':
                    $message = 'Smartbit la informa che la sua riparazione è stata appena iniziata: '."\n\n".'-stato →'.$repair->stato.".\n".'-dispositivo →'.$device->model.".\n\n".'Buona giornata da Smartbit!'."🤖";
                    $sms_sb = SMSGateway::sendMessageToNumber($number,$message,$deviceID);
                    return $sms_sb;
                    break;
                case 'finita':
                    $message = 'Smartbit la informa che la sua riparazione è stata appena terminata e a breve potrà essere ritirara: '."\n\n".'-stato →'.$repair->stato.".\n".'-dispositivo →'.$device->model.".\n\n".'Buona giornata da Smartbit!'."🤖";
                    $sms_sb = SMSGateway::sendMessageToNumber($number,$message,$deviceID);
                    return $sms_sb;
                    break;
            }
            $options = [
            'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
            'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
            ];
            
        }catch(ModelNotFoundException $ex){
            return $ex;
        }
    }
    //
}
