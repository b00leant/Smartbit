@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    @if(Auth::user()->id===1)
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Conferma?</h4>
            <p>Sicuro di eliminare la riparazione dal Database di Smartbit?</p>
        </div>
        <div class="modal-footer">
            <a href="{{url('delete-repair/'.$repair->id)}}"  class=" modal-action modal-close waves-effect waves-green btn-flat">Elimina</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
    @endif
    <div class="row" style="padding-top:2em">
        <div class="section col s12 m6">
            <div style="text-align:center">
                <i class="medium material-icons">perm_identity</i>
            </div>
            <div class="divider"></div>
            <p >Nome: {{$person->nome}}</p>
            <div class="divider"></div>
            <p >Cognome: {{$person->cognome}}</p>
            <div class="divider"></div>
            <p >Recapito: {{$person->telefono}}</p>
            <div class="divider"></div>
        </div>
        <div class="section col s12 m6">
            <div style="text-align:center">
                <i class="medium material-icons">phone_iphone</i>
            </div>
            <div class="divider"></div>
            <p >Modello: {{$device->model}}</p>
            <div class="divider"></div>
            <p >Marca: {{$device->brand}}</p>
            <div class="divider"></div>
            <p>Stato: {{$repair->stato}}</p>
            <div class="divider"></div>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
          <textarea readonly id="note" class="materialize-textarea">{{$repair->note}}</textarea>
          <label for="note">Note Cliente</label>
        </div>
        <div class="input-field col s6">
          <textarea readonly id="notelab" class="materialize-textarea">{{$repair->note_lab}}</textarea>
          <label for="notelab">Note Laboratorio</label>
        </div>
      </div>
    <div class="row center-align">
        <a class="waves-effect waves-light btn-flat smartbit" style="color:white">
        <i class="material-icons">perm_phone_msg</i>
        </a>
        <a href="{{url('/person/'.$person->id)}}" class="waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">perm_identity</i>
        </a>
        <a href="{{url('ricevuta/'.$repair->id)}}" class="waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">print</i>
        </a>
        @if(Auth::user()->id===1)
        <a href="{{url('lab')}}" class="waves-effect waves-light btn-flat amber accent-4" style="color:white">
            <i class="material-icons">settings</i>
        </a>
        @endif
        @if(Auth::user()->id===1)
        <a class="waves-effect waves-light btn-flat red"  href="#modal1" style="color:white">
            <i class="material-icons">delete</i>
        </a>
        @endif
    </div>
    
</div>
@endif
@endsection