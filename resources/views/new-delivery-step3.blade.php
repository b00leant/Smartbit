@extends('layouts.app')
@section('content')
@if(Auth::user()->id ===1 or Auth::user()->id ===2)
<div class="row" style="padding-top:70px">
    <form action="{{ url('select-date-delivery') }}" id="create" method="POST">
                    <input type="hidden" name="center" value="{{$center}}">
                    <input type="hidden" name="json_repairs" value="{{$old_repairs}}">
                    {{ csrf_field() }}
        <div class="col s12">
            <nav>
                <div class="nav-wrapper">
                    <div class="col s12">
                        <a href="{{url('new-delivery')}}" class="breadcrumb">Centro</a>
                        <a class="breadcrumb">Riparazioni</a>
                        <a class="breadcrumb">Data</a>
                    </div>
                </div>
            </nav>
            <div class="row">
                <h2 class="col s12 header">Seleziona Data</h2>
                <div class="input field col s12">
                    <input type="date" autofocus name="date_delivery" value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" class="date_delivery">
                </div>
                <ul class="collection with-header">
                    <li class="collection-header">
                        <h4>Centro Riparazione</h4>
                    </li>
                    <li class="collection-item avatar">
                      <!--[if !IE]> -->
                        <i class="material-icons circle smartbit">location_on</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons circle smartbit">&#xE0C8;</i>
                        <![endif]-->
                      <span class="title">{{$centerobj->nome}}</span>
                      <p>{{$centerobj->indirizzo}} <br>
                         recapito: {{$centerobj->telefono}}
                      </p>
                      <!--a href="#!" class="secondary-content"><i class="material-icons">grade</i></a-->
                    </li>
                </ul>
                <ul class="collection with-header">
                    @if(isset($repairs))
                    <li class="collection-header"><h4>Riparazioni da spedire</h4></li>
                    @foreach(json_decode($repairs) as $repair)
                    <li class="collection-item">Seriale: {{$repair->seriale}}</li>
                    @endforeach
                    @else
                    <span>Non sono state trovate riparazioni, riprova!</span>
                    @endif
                  </ul>
                
            </div>
        </div>
        <div class="fixed-action-btn">
        <button class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
            <!--[if !IE]> -->
        <i class="material-icons large">done</i>
        <!-- <![endif]-->
        <!--[if lt IE 9]>
        <i class="material-icons large">&#xE876;</i>
        <![endif]-->
        </button>
        </div>
        </form>
</div>
@endif
@endsection