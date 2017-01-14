@extends('layouts.app')

@section('content')
<!--div style="position:absolute;width:100%;padding-top:90px">
    <div class="fairyoutl " id="open" style="padding:0">
    </div>
    <div class="fairyl " id="open" style="padding:0">
    </div>
    <div class="fairyoutr " id="open" style="padding:0">
    </div><div class="fairyr" id="open" style="padding:0">
    </div>
    <div class="hour-banner" id="open" style="border:0px;
    background-color: rgb(6, 86, 116);font-size:1em">
      Benvenuto nel laboratorio {{ Auth::user()->username }}
    </div>
</div-->
<div class="home row">
  <div class="col s12">
      <div class="section">
        <div id="lab" class="collection with-header container">
          
          <div class="collection-header">
            <h4>Riparazioni</h4>
            <!--a class="btn-floating btn waves-effect waves-light smartbit" href="#">
                <i class="material-icons">add</i>
            </a-->
          </div>
          @if(isset($repairs_pages))
            @foreach($repairs_pages as $repair)
              <a data-activates="slide-lab" data-id="{{$repair->id}}" class="collection-item lab-item">
                <div class="secondary-content">
                  @if($repair->stato === 'creata')
                  <!--[if !IE]> -->
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Creata">hourglass_empty</i>
                  <!-- <![endif]-->
                  <!--[if lt IE 9]>
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Creata">&#xE88B;</i>
                  <![endif]-->
                  @elseif($repair->stato === 'iniziata')
                  <!--[if !IE]> -->
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Iniziata">done</i>
                  <!-- <![endif]-->
                  <!--[if lt IE 9]>
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Iniziata">&#xE876;</i>
                  <![endif]-->
                  @elseif($repair->stato === 'finita')
                  <!--[if !IE]> -->
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Finita (non ancora pronta)">done_all</i>
                  <!-- <![endif]-->
                  <!--[if lt IE 9]>
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Finita (non ancora pronta)">&#xE877;</i>
                  <![endif]-->
                  @elseif($repair->stato === 'pronta')
                  <!--[if !IE]> -->
                  <i class="material-icons tooltipped" style="color:#4CAF50" data-tooltip="Pronta per il ritiro">done_all</i>
                  <!-- <![endif]-->
                  <!--[if lt IE 9]>
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Pronta per il ritiro">&#xE877;</i>
                  <![endif]-->
                  @elseif($repair->stato === 'consegnata')
                  <!--[if !IE]> -->
                  <i class="material-icons tooltipped" style="color:#4CAF50" data-tooltip="Consegnata">tag_faces</i>
                  <!-- <![endif]-->
                  <!--[if lt IE 9]>
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="Consegnata">&#xE420;</i>
                  <![endif]-->
                  @else
                  <i class="material-icons tooltipped" style="color:grey" data-tooltip="senza stato">error</i>
                  @endif
                </div>Seriale: {{$repair->seriale}}   Modello:{{$repair->device->model}}   ({{$repair->person->nome}} {{$repair->person->cognome}})
              </a>
            @endforeach
          @endif
        </div>
        <div style="text-align:center;padding:2em">
          @if($repairs_pages->nextPageUrl() != null)
          <a class="btn-floating btn waves-effect waves-light refresh-lab smartbit" href="page=2">
            <i class="material-icons">refresh</i>
                  <!-- <![endif]-->
                  <!--[if lt IE 9]>
                  <i class="material-icons>&#xE5D5;</i>
                  <![endif]-->
          </a>
          @endif
        </div>
      </div>
  </div>
</div>
<!-- Modal Change -->
  <div id="modal-change" class="modal">
    <div class="modal-content">
      <h4>Sei sicuro?</h4>
      <p>
        Una volta finita, una riparazione deve essere trasportata in negozio.
        Se finita, questa riparazione verrà aggiunta alla lista delle pianificazioni
        per essere riconsegnata insieme alle altre.
      </p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-red btn-flat">Cancella</a>
      <a class="finish-action modal-action modal-close waves-effect waves-green btn-flat">Okay</a>
    </div>
  </div>
@endsection
  

<!--div style="position:fixed;bottom:0px;height:50%;border-radius: 100% 100% 0px 0px;
-moz-border-radius: 100% 100% 0px 0px;
-webkit-border-radius: 100% 100% 0px 0px;
border: 0px solid #000000;width:100%;background:#ffab00;padding-top: 10%;">
    <div class="container">
        <ul class="collection">
    <li class="collection-item avatar">
      <i class="material-icons circle red">play_arrow</i>
      <span class="title">Title</span>
      <p>First Line <br>
         Second Line
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>
    <li class="collection-item avatar">
      <i class="material-icons circle">folder</i>
      <span class="title">Title</span>
      <p>First Line <br>
         Second Line
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>
    <li class="collection-item avatar">
      <i class="material-icons circle green">insert_chart</i>
      <span class="title">Title</span>
      <p>First Line <br>
         Second Line
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>
    <li class="collection-item avatar">
      <i class="material-icons circle red">play_arrow</i>
      <span class="title">Title</span>
      <p>First Line <br>
         Second Line
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
    </li>
  </ul>
    </div>
</div-->