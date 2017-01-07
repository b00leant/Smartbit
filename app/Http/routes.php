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

Route::get('/lab', 'LabController@home')->middleware('auth');

Route::auth();

Route::get('/', 'HomeController@home');

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/#riparazioni', 'RepairController@index')->middleware('auth');

Route::get('/new#repair', 'RepairController@create')->middleware('auth');

Route::get('/select-repair-owner','RepairController@selectOwnerForm')->middleware('auth');

Route::get('/select-repair-device','RepairController@selectDeviceForm')->middleware('auth');

Route::get('create-person','PersonController@showCreateForm')->middleware('auth');

//Route::get('/check-session-for-repair','SessionController@checkSessionForRepair')->middleware('auth');

Route::get('/ajax-people', 'AjaxController@people')->middleware('auth');

Route::post('/repairs-pagination','RepairController@index')->middleware('auth');

Route::post('/people-pagination','PersonController@index')->middleware('auth');

Route::post('/lab-pagination','LabController@index')->middleware('auth');

Route::get('/repair/{id}',['uses'=>'RepairController@showRepair'])->middleware('auth');

Route::post('/change-state-lab/{id}',['uses'=>'LabController@changeState'])->middleware('auth');

Route::post('/update-note-lab/{id}',['uses'=>'LabController@updateNoteLab'])->middleware('auth');

Route::post('/repair-info','RepairController@info')->middleware('auth');

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

Route::get('delivery-go/{id}',['uses'=>'PDFController@ddt'])->middleware('auth');

Route::get('pickup-go/{id}',['uses'=>'PDFController@ddtPickup'])->middleware('auth');

Route::get('/ricevuta/{id}',['uses'=>'PDFController@ricevuta'])->middleware('auth');

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





//Route::get('/ajax-search-models', 'AjaxController@searchModels');