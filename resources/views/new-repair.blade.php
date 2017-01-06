@extends('layouts.app')

@section('content')
@if(Auth::check())
<div class="row">
    <h5 class="center">Seleziona il modello per {{$data->nome}} {{$data->cognome}}</h5>
    <div class="divider"></div>
    <script>
        //console.log('nella sessione si sta usando la persona:s');
    </script>
    <form method="POST" action="{{ url('create-repair') }}" id="create">
        <div class="col s12 m6 l6">
            <input type="hidden" name="nome-own" value="{{$data->nome}}">
                <input type="hidden" name="cognome-own" value="{{$data->cognome}}">
                <input type="hidden" name="id-own" value="{{$data->id}}">
            <div class="input-field col s12">
                {{ csrf_field() }}
                <!--i class="material-icons prefix">textsms</i-->
                <input type="hidden" name="id" value="">
                <input type="hidden" name="brand" value="">
                <input type="hidden" name="model" value="">
                <input required type="text" name="devicecomplete" value="" autocomplete="off" onkeyup="handleKeyUpDevices()" id="autocomplete-devices" class="autocomplete devices">
                <label for="autocomplete-devices">Modello/Sigla</label>
            </div>
            <div class="input-field col s12">
                <input required type="text" name="imei"  value="" autocomplete="off" id="imei" class="imei">
                <label for="imei">Inserisci Imei</label>
            </div>
            <div class="input-field col s12">
                <textarea  required name="description"  value="" placeholder="Esempio: “non funziona lo schermo, il cliente ha provato a riavviarlo ma crede che sia una questione di MAGIA NERA! ⚡”"  id="description" class="materialize-textarea"></textarea>
                <label for="description">Descrivi il difetto</label>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <p>
              <input name="garanzia" value="true" type="checkbox" id="garanzia" />
              <label for="garanzia">In Garanzia?</label>
            </p>
            <p>
              <input name="assistenza" value="true" type="checkbox" id="assistenza" />
              <label for="assistenza">Da spedire in assistenza?</label>
            </p>
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Carica foto scontrino">
                </div>
            </div>
            <br><br>
            <div class="chips chips-placeholder autocomplete parts" data-index="0" data-initialized="true">
                <input id="70a3d71f-87a6-94d1-771a-ac07379c7386" class="input" placeholder="+Tag">
            </div>
        </div>
    </form>
    <div class="fixed-action-btn">
        <button class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
          <i class="large material-icons">done</i>
        </button>
    <!--ul>
      <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
      <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul-->
    </div>
    <!--div class="fixed-action-btn" style="left:23px">
        <button class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
          <i class="large material-icons">arrow_back</i>
        </button>
    </div-->
</div>
<!--script per refreshare la pagina sul back button>
<input type="hidden" id="refreshed" value="no">
<script>
    onload=function(){
    var e=document.getElementById("refreshed");
    if(e.value=="no")e.value="yes";
    else{e.value="no";location.reload();}
    }
</script-->
@endif
@endsection