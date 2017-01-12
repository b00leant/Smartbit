@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    @if(Auth::user()->id===2)
    <div id="modal-delete" class="modal">
        <div class="modal-content">
            <h4>Conferma?</h4>
            <p>Sicuro di eliminare la riparazione dal Database di Smartbit?</p>
        </div>
        <div class="modal-footer">
            <a href="{{url('delete-repair/'.$repair->id)}}"  class=" modal-action modal-close waves-effect waves-red btn-flat">Elimina</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-light btn-flat">Annulla</a>
        </div>
    </div>
    @endif
    <div id="modal-giveback" class="modal">
        <div class="modal-content">
            <h4>Consegnare al cliente?</h4>
            <p>Confermi la consegna del dispositivo al cliente?</p>
            <p>Procedi solo se il cliente è in possesso della ricevuta.</p>
        </div>
        <div class="modal-footer">
            <a href="{{url('giveback-repair/'.$repair->id)}}"  class=" modal-action modal-close waves-effect waves-smartbit btn-flat">Consegna</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-light btn-flat">Annulla</a>
        </div>
    </div>
    
    <div class="row" style="padding-top:2em">
        <div class="section col s12 m6">
            <div style="text-align:center">
                <i class="medium material-icons">perm_identity</i>
            </div>
            <div class="divider"></div>
            <p class="nome-ricevuta">Nome: {{$person->nome}}</p>
            <div class="divider"></div>
            <p class="cognome-ricevuta">Cognome: {{$person->cognome}}</p>
            <div class="divider"></div>
            <p class="recapito-ricevuta">Recapito: {{$person->telefono}}</p>
            <div class="divider"></div>
        </div>
        <div class="section col s12 m6">
            <div style="text-align:center">
                <i class="medium material-icons">phone_iphone</i>
            </div>
            <div class="divider"></div>
            <p class="modello-ricevuta">Modello: {{$device->model}}</p>
            <div class="divider"></div>
            <p class="marca-ricevuta">Marca: {{$device->brand}}</p>
            <div class="divider"></div>
            <p class="imei-ricevuta">Imei: {{$device->imei}}</p>
            <div class="divider"></div>
            <div id="to print" style="display:none">
                <p>Riparazione</p>
                <p class="today" style="display:none">{{ $repair->created_at }}</p>
                <canvas id="barcode"></canvas>
            </div>
            <input type="hidden" name="seriale" value="{{$repair->seriale}}">
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
          <textarea readonly id="note" class="note-ricevuta materialize-textarea">{{$repair->note}}</textarea>
          <label for="note">Note Cliente</label>
        </div>
        <div class="input-field col s6">
          <textarea readonly id="notelab" class="materialize-textarea">{{$repair->note_lab}}</textarea>
          <label for="notelab">Note Laboratorio</label>
        </div>
      </div>
    <div class="row center-align">
        <a data-id="{{$repair->id}}" class="send_sms_status waves-effect waves-light btn-flat smartbit" style="color:white">
        <i class="material-icons">perm_phone_msg</i>
        </a>
        <a href="{{url('/person/'.$person->id)}}" class="waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">perm_identity</i>
        </a>
        <!--a href="{{url('ricevuta/'.$repair->id)}}" target="_blank" class="waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">print</i>
        </a-->
        <a class="print-repair waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">print</i>
        </a>
        @if(Auth::user()->id===1 or Auth::user()->id===2 )
        @if($repair->stato === 'iniziata' or $repair->stato === 'creata')
        <a href="{{url('lab')}}" class="waves-effect waves-light btn-flat amber accent-4" style="color:white">
            <i class="material-icons">settings</i>
        </a>
        @endif
        @endif
        @if(Auth::user()->id===2)
        <a class="waves-effect waves-light btn-flat red" href="#modal-delete" style="color:white">
            <i class="material-icons">delete</i>
        </a>
        @endif
        @if($repair->stato === 'finita')
        <a class="waves-effect waves-light btn-flat smartbit" href="#modal-giveback" style="color:white">
            <i class="material-icons">done</i>
        </a>
        @endif
    </div>
    
</div>
@endif
@endsection