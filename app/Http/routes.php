<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/not-supported', 'HomeController@ns');

Route::group(['middleware' => 'bdetect'], function () {
    
    Route::auth();
    
    Route::get('/','HomeController@root');
    
    Route::get('/home', 'HomeController@home')->middleware('auth');
    
    Route::get('/lab', 'LabController@home')->middleware('auth');
    
    Route::get('/#riparazioni', 'RepairController@index')->middleware('auth');
    
    Route::get('/new#repair', 'RepairController@create')->middleware('auth');
    
    Route::get('/select-repair-owner','RepairController@selectOwnerForm')->middleware('auth');
    
    Route::get('/select-repair-device','RepairController@selectDeviceForm')->middleware('auth');
    
    Route::get('create-person','PersonController@showCreateForm')->middleware('auth');
    
    Route::get('/ajax-people', 'AjaxController@people')->middleware('auth');
    
    Route::get('/ajax-repairs', 'AjaxController@repairs')->middleware('auth');
    
    Route::post('/repairs-pagination','RepairController@index')->middleware('auth');
    
    Route::get('/search-phonearena/{term}',['uses'=>'AjaxController@phonearena'])->middleware('auth');
    
    Route::get('/phone-arena-img/{term}',['uses'=>'AjaxController@phonearenaimg'])->middleware('auth');
    
    Route::get('/search-phonearena-json/{terms}',['uses'=>'AjaxController@phonearenajson'])->middleware('auth');
    
    Route::post('/people-pagination','PersonController@index')->middleware('auth');
    
    Route::post('/lab-pagination','LabController@index')->middleware('auth');
    
    Route::get('/repair/{id}',['uses'=>'RepairController@showRepair'])->middleware('auth');
    
    Route::post('/change-state-lab/{id}',['uses'=>'LabController@changeState'])->middleware('auth');
    
    Route::get('/finish-state-lab/{id}',['uses'=>'LabController@finishLab'])->middleware('auth');
    
    Route::post('/update-note-lab/{id}',['uses'=>'LabController@updateNoteLab'])->middleware('auth');
    
    Route::post('/repair-info','RepairController@info')->middleware('auth');
    
    Route::get('/set-deliverable-lab/{id}',['uses'=>'LabController@deliverableLab'])->middleware('auth');
    
    Route::get('person/{id}', ['uses' =>'PersonController@show'])->middleware('auth');
    
    Route::get('add-person','PersonController@showFormCreateToUse')->middleware('auth');
    
    Route::get('/delete-repair/{id}', ['uses' =>'RepairController@handleDelete'])->middleware('auth');
    
    Route::get('/delete-delivery/{id}', ['uses' =>'DeliveryController@handleDelete'])->middleware('auth');
    
    Route::get('/edit-delivery/{id}', ['uses' =>'DeliveryController@editForm'])->middleware('auth');
    
    Route::get('/new-tech-sup', 'TechnicalSupportController@create')->middleware('auth');
    
    Route::get('/new-pickup', 'DeliveryController@selectTechnicalSupportPickup')->middleware('auth');
    
    Route::get('/new-delivery', 'DeliveryController@selectTechnicalSupport')->middleware('auth');
    
    Route::get('deliveries','DeliveryController@home')->middleware('auth');
    
    Route::get('delivery/{id}',['uses'=>'DeliveryController@show'])->middleware('auth');
    
    Route::get('delivery-info/{id}',['uses'=>'DeliveryController@info'])->middleware('auth');
    
    Route::get('delivery-go/{id}',['uses'=>'DeliveryController@ddt'])->middleware('auth');
    
    Route::get('pickup-go/{id}',['uses'=>'DeliveryController@ddtPickup'])->middleware('auth');
    
    Route::get('/ricevuta/{id}',['uses'=>'PDFController@ricevuta'])->middleware('auth');
    
    Route::get('/giveback-repair/{id}',['uses'=>'RepairController@giveback'])->middleware('auth');
    
    //posts--------------------------------------------------------------------
    
    Route::post('/create-pickup','DeliveryController@createPickup');
    
    Route::post('/update-pickup/{id}',['uses'=>'DeliveryController@updatePickup'])->middleware('auth');
    
    Route::post('/update-delivery/{id}',['uses'=>'DeliveryController@update'])->middleware('auth');
    
    Route::post('/select-tech-sup','DeliveryController@selectDeliveries')->middleware('auth');
    
    Route::post('/select-repair-delivery','DeliveryController@selectDate')->middleware('auth');
    
    Route::post('/select-date-delivery','DeliveryController@handleCreate')->middleware('auth');
    
    Route::post('/create-tech-sup', 'TechnicalSupportController@handleCreate')->middleware('auth');
    
    Route::post('new-repair','RepairController@checkOwner')->middleware('auth');
    
    Route::post('/create-repair','RepairController@handleCreate')->middleware('auth');
    
    Route::post('create-to-use','PersonController@handleCreateToUse')->middleware('auth');
    
    Route::post('create-person','PersonController@handleCreateToUse')->middleware('auth');
    
    Route::post('sms-status-repair/{id}',['uses' => 'AjaxController@sendSMSRepairStatus'])->middleware('auth');
    
    //Route::get('/ajax-search-models', 'AjaxController@searchModels');
    Route::get('rpt','HomeController@rpt');
});
