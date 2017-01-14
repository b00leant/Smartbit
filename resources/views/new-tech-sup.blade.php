@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="container">
    <h4 class="center">Crea Nuovo Centro di Riparazione</h4>
    <div class="row">
    <form action="{{ url('create-tech-sup') }}" method="POST" id="create">
        <div class="input-field col s12">
            {{ csrf_field() }}
            <input required type="text" id="marca" name="marca" value="" autocomplete="off">
            <label for="marca">Marca</label>
        </div>
        <div class="input-field col s6">
            <input required type="text" id="nome" name="nome" value="" autocomplete="off">
            <label for="nome">Nome</label>
        </div>
        <div class="input-field col s6">
            <input required type="tel" id="tel" name="telefono" value="" autocomplete="off">
            <label for="tel">Telefono</label>
        </div>
    
</div>
</div>
<div class="row">
    <div class="input-field col s6 offset-s3" style="z-index: 1;">
            <!--i class="material-icons prefix">place</i-->
            <input required type="text" name="addr_complete" value="" style="background-color:#FFFFFF;text-align:center;" placeholder="Indirizzo" class="autocomplete address" autocomplete="off" id="addr_complete">
            <!--label for="addr_complete">Indirizzo</label-->
        </div>
        </form>
    <div class="col s12" id="map" style="height:50%;position:absolute;"></div>
    <!--div class="col s12" id="preview" style="height:50%;position:absolute;"></div-->

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
    </div>
        <!--div class="fixed-action-btn" style="left:23px">
            <a href="{{url('/#del')}}" class="create_repair btn-floating btn-large smartbit">
              <i class="large material-icons">arrow_back</i>
            </a>
        </div-->
</div>
@endif
@endsection