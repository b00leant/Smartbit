@extends('layouts.pdf')
@section('content')
@if(Auth::check())
<h1 style="padding:1em;color:white;background:#085674;text-align:center">Ricevuta riparazione Smartbit SRL</h1><br>

<div style="width:50%;margin-left:25%;text-align:center">
<img style="padding:0.2em" src="{{resource_path('images/ic.png')}}">
<div style="padding:0%;margin:0 0% 0 0%;text-align:center;border:2px solid #085674">
    <p>Centro: {{$delivery->technicalSupport->nome}}</p>
    <p>Indirizzo: {{$delivery->technicalSupport->indirizzo}}</p>
    <p>Telefono: {{$delivery->technicalSupport->telefono}}</p>
    <p>Data: {{$delivery->task_consegna}}</p>
</div>
</div>

<div style="width:100%;text-align:center;">
    <img style="padding:0.2em" src="{{resource_path('images/id.png')}}">
</div>
<div style="width:50%;margin-left:25%;padding-top:0.2em;text-align:center;"> 
        @foreach($repairs as $repair)
    <div style="width:100%;padding:0.3em;margin:0.3em;border:2px solid #085674;text-align:left">
        <p>MODELLO:{{$repair->device->model}} {{$repair->device->brand}}</p>
        <p>IMEI:{{$repair->device->imei}}</p>
        <p>NOTE:{{$repair->note}}</p>
    </div>
    @endforeach
</div>

@endif
@endsection