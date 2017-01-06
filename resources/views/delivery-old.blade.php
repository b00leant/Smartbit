@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="row" style="padding-top:70px">
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Conferma?</h4>
            <p>Sicuro di eliminare la spedizione dal Database di Smartbit?</p>
        </div>
        <div class="modal-footer">
            <a href="{{url('delete-delivery/'.$delivery->id)}}"  class=" modal-action modal-close waves-effect waves-green btn-flat">Elimina</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
        <div class="col s12 m8 offset-m2">
            <div class="row">
                <ul class="collection with-header">
                    <li class="collection-header">
                        <h4>Centro Riparazione</h4>
                    </li>
                    <li class="collection-item avatar">
                      <i class="material-icons smartbit circle">location_on</i>
                      <span class="title">{{$delivery->technicalSupport->nome}}</span>
                      <p class="truncate">{{$delivery->technicalSupport->indirizzo}} <br>
                         recapito: {{$delivery->technicalSupport->telefono}}
                      </p>
                      <!--a href="#!" class="secondary-content"><i class="material-icons">grade</i></a-->
                    </li>
                </ul>
                <ul class="collection with-header">
                    @if(isset($delivery->repairs))
                    <li class="collection-header"><h4>Dispositivi da spedire</h4></li>
                    @foreach($delivery->repairs as $repair)
                    <li class="collection-item">{{$repair->device->model}} ({{$repair->seriale}})</li>
                    @endforeach
                    @else
                    <span>non sono state trovate riparazioni, riprova!</span>
                    @endif
                  </ul>
                <div class="input field col s12">
                    <h4>Data Spedizione</h4>
                    <input type="hidden" name="dlid_" value="{{$delivery->id}}">
                    <input type="date" name="date" value="{{$delivery->task_consegna}}" readonly>
                </div>
            </div>
        </div>
        @if(Auth::user()->id===1)
        <div class="col s12 center-align">
        <a href="{{url('edit-delivery/'.$delivery->id)}}"class="waves-effect waves-teal btn-flat smartbit" style="color:white">
            <i class="material-icons">edit</i>
        </a>
        
        <a class="waves-effect waves-teal btn-flat red"  href="#modal1" style="color:white">
            <i class="material-icons">delete</i>
        </a>
    </div>
    @endif
</div>
@endif
@endsection