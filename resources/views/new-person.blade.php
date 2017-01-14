@extends('layouts.app')

@section('content')
@if(Auth::check())
@if(isset($create2use))
    <form method="POST" action="{{ url('create-to-use') }}" id="create">
        <input type="hidden" name="repair_after" value="true"/>
    @else
    <form method="POST" action="{{ url('create-person') }}" id="create">
    @endif
<div class="row" style="padding-top: 100px;">
    <div class="divider"></div>
        <div class="col s12 m6 l6">
            <div class="input-field col s6">
                {{ csrf_field() }}
                <!--[if !IE]> -->
                <i class="material-icons prefix">account_circle</i>
                <!-- <![endif]-->
                <!--[if lt IE 9]>
                <i class="material-icons prefix">&#xE853;</i>
                <![endif]-->
                <input required type="text" name="nome" value="" autocomplete="off" id="name" class="">
                <label for="name">Nome</label>
            </div>
            <div class="input-field col s6">
                <input required type="text" name="cognome"  value="" autocomplete="off" id="cognome" class="">
                <label for="cognome">Cognome</label>
            </div>
            <div class="input-field col s12">
                <!--[if !IE]> -->
                <i class="material-icons prefix">cake</i>
                <!-- <![endif]-->
                <!--[if lt IE 9]>
                <i class="material-icons prefix">&#xE7E9;</i>
                <![endif]-->
                <input required type="date" name="datanascita" value="" autocomplete="off" id="birthday" class="datanascita">
                <label for="birthday">Data di nascita</label>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div class="input-field col s12">
                <!--[if !IE]> -->
                <i class="material-icons prefix">mail_outline</i>
                <!-- <![endif]-->
                <!--[if lt IE 9]>
                <i class="material-icons prefix">&#xE0E1;</i>
                <![endif]-->
                <input required type="email" name="email"  value="" autocomplete="off" id="email" class="validate">
                <label for="email" data-error="wrong" data-success="right">Email</label>
            </div>
            <div class="input-field col s12">
                <!--[if !IE]> -->
                <i class="material-icons prefix">phone</i>
                <!-- <![endif]-->
                <!--[if lt IE 9]>
                <i class="material-icons prefix">&#xE0CD;</i>
                <![endif]-->
                <input required type="tel" name="telefono" value="" autocomplete="off" id="tel">
                <label for="tel">Telefono</label>
            </div>
        </div>
        
</div>
<div class="row">
    <div class="input-field col s6 offset-s3" style="z-index: 1;">
        <!--i class="material-icons prefix">place</i-->
        <input required type="text" name="addr_complete" value="" style="background-color:#FFFFFF;text-align:center;" placeholder="Indirizzo" class="autocomplete address" autocomplete="off" id="addr_complete">
        <label for="addr_complete">Indirizzo</label>
    </div>
    <div class="col s12" id="map" style="height:50%;position:absolute;"></div>
    <!--div class="col s12" id="preview" style="height:50%;position:absolute;"></div-->
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
    <!--div class="fixed-action-btn" style="left:23px">
        <button class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
          <i class="large material-icons">arrow_back</i>
        </button>
    </div-->
    <!--script per refreshare la pagina sul back button-->
    <input type="hidden" id="refreshed" value="no">
    <script>
        onload=function(){
        var e=document.getElementById("refreshed");
        if(e.value=="no")e.value="yes";
        else{e.value="no";location.reload();}
        }
    </script>
@endif
@endsection