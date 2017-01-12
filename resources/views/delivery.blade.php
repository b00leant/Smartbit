@extends('layouts.app')
@section('content')
@if(Auth::check())
@if($delivery->stato == 'creata')
<div class="row" style="padding-top:70px">
    <div id="modal-chose-go" class="modal">
        <div class="modal-content">
            <h4>Sei sicuro di voler spedire?</h4>
            <p>Una volta stampata la ricevuta non potrai più modificarla</p>
        </div>
        <div class="modal-footer">
            <a  target="_blank" class="modal-action modal-close waves-effect waves-light btn-flat  smartbit white-text">Stampa e vai!</a>
            <a class=" modal-action modal-close waves-effect waves-light btn-flat">Annulla</a>
        </div>
    </div>
    <div id="modal-chose-center" class="modal">
        <div class="modal-content">
            <h4>Scegli il centro</h4>
            <p>Scegline solo uno</p>
            <div class="collection">
                @foreach($tech_sups as $centerobj)
                <a data-rec="{{$centerobj->telefono}}"
                        data-address="{{$centerobj->indirizzo}}"
                        data-title="{{$centerobj->nome}}"
                        data-id="{{$centerobj->id}}" class="collection-item avatar">
                      <i class="material-icons smartbit circle">location_on</i>
                      <span class="title">{{$centerobj->nome}}</span>
                      <!--p>{{$centerobj->indirizzo}} <br>
                         recapito: {{$centerobj->telefono}}
                      </p-->
                      <span href="#!" class="secondary-content"><i class="material-icons">add</i></span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <a class="add-center-to-delivery modal-action modal-close waves-effect waves-green btn-flat">Aggiungi</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
    <div id="modal-chose-repair" class="modal">
        <div class="modal-content">
            <h4>Aggiungi Dispositivi da spedire</h4>
            <p>Scegli dalla lista:</p>
            <ul class="collection with-header">
                    @if(isset($repairs))
                    @foreach($repairs as $repair)
                    <li data-id="{{$repair->id}}" class="collection-item">{{$repair->device->model}} ({{$repair->person->nome}} {{$repair->person->cognome}})</li>
                    @endforeach
                    @else
                    <span>non sono state trovate riparazioni, riprova!</span>
                    @endif
                  </ul>
        </div>
        <div class="modal-footer">
            <a class="update-repair-to-delivery modal-action modal-close waves-effect waves-green btn-flat">Aggiungi</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
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
                <ul id="edit-delivery-center" class="collection with-header">
                    <li class="collection-header">
                        <h4>Centro Riparazione</h4>
                    </li>
                    <a data-rec="{{$delivery->technicalSupport->telefono}}"
                        data-address="{{$delivery->technicalSupport->indirizzo}}"
                        data-title="{{$delivery->technicalSupport->nome}}"
                        data-id="{{$delivery->technicalSupport->id}}"
                        href=""
                        class="collection-item avatar">
                      <i class="material-icons smartbit circle">location_on</i>
                      <span class="title">{{$delivery->technicalSupport->nome}}</span>
                      <p>{{$delivery->technicalSupport->indirizzo}} <br>
                         recapito: {{$delivery->technicalSupport->telefono}}
                      </p>
                      <span href="#!" class="hide secondary-content"><i class="material-icons">edit</i></span>
                    </a>
                </ul>
                <ul id="edit-delivery-repairs" class="collection with-header">
                    @if(isset($delivery->repairs))
                    <li class="collection-header"><h4>Dispositivi da spedire</h4></li>
                    @foreach($delivery->repairs as $repair)
                    <a data-id="{{$repair->id}}" data-show="{{$repair->device->model}} ({{$repair->person_name}})" class="edit-delivery-repair collection-item">
                        {{$repair->device->model}} ({{$repair->person_name}})
                        <span style="cursor:pointer" class="hide remove-repair-from-delivery secondary-content"><i class="material-icons">delete</i></span>
                    </a>
                    @endforeach
                    @else
                    <span>non sono state trovate riparazioni, riprova!</span>
                    @endif
                  </ul>
                  <div class="col s12" style="text-align:center">
                      <a href="" class="trigger-to-add-repairs hide btn-floating btn-large waves-effect waves-light smartbit">
                            <i class="material-icons">add</i>
                        </a>
                  </div>
                  <input type="hidden" name="repairs_to_update" value="">
                  <input type="hidden" name="center_to_update" value="">
                <div class="input field col s12">
                    <h4>Data Spedizione</h4>
                    <input type="hidden" name="dlid_" value="{{$delivery->id}}">
                    <input disabled style="color:black" type="date" name="date" value="{{$delivery->task_consegna}}" readonly>
                </div>
            </div>
        </div>
        @if(Auth::user()->id===1)
        <div class="col s12 center-align">
            <a  class="activate-edit-mode-delivery waves-effect waves-light btn-flat smartbit" style="color:white">
                <i class="material-icons">edit</i>
            </a>
            <a class="hide cancel-edit-delivery waves-effect waves-light btn-flat red" style="color:white">
                <i class="material-icons">cancel</i>
            </a>
            <a class="hide update-delivery waves-effect waves-light btn-flat smartbit" style="color:white">
                <i class="material-icons">save</i>
            </a>
            <a class=" waves-effect go-delivery waves-light btn-flat smartbit" href="#modal-chose-go" style="color:white">
                <i class="material-icons">local_shipping</i>
            </a>
            <a class="delete-delivery waves-effect waves-light btn-flat red"  href="#modal1" style="color:white">
                <i class="material-icons">delete</i>
            </a>
        </div>
    @endif
</div>
@elseif($delivery->stato == 'da_ritirare')
<div class="row" style="padding-top:70px">
    <div id="modal-chose-go" class="modal">
        <div class="modal-content">
            <h4>Sei sicuro di voler ritirare?</h4>
            <p>Una volta stampata la ricevuta non potrai più modificarla</p>
        </div>
        <div class="modal-footer">
            <a  target="_blank" class="modal-action modal-close waves-effect waves-light btn-flat  smartbit white-text">Stampa e vai!</a>
            <a class=" modal-action modal-close waves-effect waves-light btn-flat">Annulla</a>
        </div>
    </div>
    <div id="modal-chose-center" class="modal">
        <div class="modal-content">
            <h4>Scegli il centro</h4>
            <p>Scegline solo uno</p>
            <div class="collection">
                @foreach($tech_sups as $centerobj)
                <a data-rec="{{$centerobj->telefono}}"
                        data-address="{{$centerobj->indirizzo}}"
                        data-title="{{$centerobj->nome}}"
                        data-id="{{$centerobj->id}}" class="collection-item avatar">
                      <i class="material-icons smartbit circle">location_on</i>
                      <span class="title">{{$centerobj->nome}}</span>
                      <!--p>{{$centerobj->indirizzo}} <br>
                         recapito: {{$centerobj->telefono}}
                      </p-->
                      <span href="#!" class="secondary-content"><i class="material-icons">add</i></span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
            <a class="add-center-to-delivery modal-action modal-close waves-effect waves-green btn-flat">Aggiungi</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
    <div id="modal-chose-repair-back" class="modal">
        <div class="modal-content">
            <h4>Aggiungi Dispositivi da ritirare</h4>
            <p>Scegli dalla lista:</p>
            <ul class="collection with-header">
                    @if(isset($repairs))
                    @foreach($repairs as $repair)
                    <li data-id="{{$repair->id}}" data-show="{{$repair->device->model}} ({{$repair->seriale}})" class="collection-item">{{$repair->device->model}} ({{$repair->person->nome}} {{$repair->person->cognome}})</li>
                    @endforeach
                    @else
                    <span>non sono state trovate riparazioni, riprova!</span>
                    @endif
                  </ul>
        </div>
        <div class="modal-footer">
            <a class="update-repair-to-back-delivery modal-action modal-close waves-effect waves-green btn-flat">Aggiungi</a>
            <a href="#"  class=" modal-action modal-close waves-effect waves-green btn-flat">Annulla</a>
        </div>
    </div>
    <div class="col s12 m8 offset-m2">
        <div class="row">
            <ul id="back-delivery-center" class="collection with-header">
                <li class="collection-header">
                    <h4>Centro Riparazione</h4>
                </li>
                <a data-rec="{{$delivery->technicalSupport->telefono}}"
                    data-address="{{$delivery->technicalSupport->indirizzo}}"
                    data-title="{{$delivery->technicalSupport->nome}}"
                    data-id="{{$delivery->technicalSupport->id}}"
                    class="collection-item avatar">
                  <i class="material-icons smartbit circle">location_on</i>
                  <span class="title">{{$delivery->technicalSupport->nome}}</span>
                  <p>{{$delivery->technicalSupport->indirizzo}} <br>
                     recapito: {{$delivery->technicalSupport->telefono}}
                  </p>
                  <span href="#!" class="hide secondary-content"><i class="material-icons">edit</i></span>
                </a>
            </ul>
            <ul id="back-delivery-repairs" class="collection with-header">
                @if(isset($delivery->repairs))
                <li class="collection-header"><h4>Dispositivi da ritirare</h4></li>
                @foreach($delivery->repairs as $repair)
                 <a data-id="{{$repair->id}}" data-show="{{$repair->device->model}} ({{$repair->seriale}})" class="back-delivery-repair collection-item"> 
                    {{$repair->device->model}} ({{$repair->seriale}})
                     <span style="cursor:pointer" class="hide remove-repair-from-delivery secondary-content"><i class="material-icons">delete</i></span> 
                 </a> 
                @endforeach
                @else
                <span>non sono state trovate riparazioni, riprova!</span>
                @endif
              </ul>
              <div class="col s12" style="text-align:center">
                  <a href="" class="hide trigger-to-add-repairs-back btn-floating btn-large waves-effect waves-light smartbit">
                        <i class="material-icons">add</i>
                    </a>
              </div>
              <input type="hidden" name="repairs_to_update" value="">
              <input type="hidden" name="center_to_update" value="">
            <div class="input field col s12">
                <h4>Data Ritiro</h4>
                <input type="hidden" name="dlid_" value="{{$delivery->id}}">
                <input disabled style="color:black" type="date" name="date" value="{{ Carbon\Carbon::today()->format('Y-m-d') }}" readonly>
            </div>
        </div>
    </div>
    @if(Auth::user()->id===1)
    <div class="col s12 center-align">
        <a  class="activate-back-mode-delivery waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">edit</i>
        </a>
        <a class="hide cancel-back-delivery waves-effect waves-light btn-flat red" style="color:white">
            <i class="material-icons">cancel</i>
        </a>
        <a class="hide update-back-delivery waves-effect waves-light btn-flat smartbit" style="color:white">
            <i class="material-icons">save</i>
        </a>
        <a class=" waves-effect go-back-delivery waves-light btn-flat smartbit" href="#modal-chose-go" style="color:white">
            <i class="material-icons">local_shipping</i>
        </a>
    </div>
    @endif
</div>
@endif
@endif
@endsection