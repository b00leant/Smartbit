@extends('layouts.app')
@section('content')
@if(Auth::user()->id ===1 or Auth::user()->id ==2)
<div class="row" style="padding-top:70px">
    <form method="POST" id="create" action="{{ url('create-pickup') }}">
                      {{ csrf_field() }}
                      <input type="hidden" value="" name="center">
        <div class="col s12">
            
            <nav>
                <div class="nav-wrapper">
                    <div class="col s12">
                        <a class="breadcrumb active">Centro</a>
                        <!--a class="breadcrumb">Riparazioni</a>
                        <a class="breadcrumb">Data</a-->
                    </div>
                </div>
              </nav>
              
              <div class="container" style="margin-top:20px">
                  <!-- da impostare la classe "active" per selezionarli -->
                  <div id="technical_supports_select" class="collection with-header">
                      @if(isset($tech_sups))
                      <div class="collection-header">
                          <h4>Seleziona il Centro</h4>
                      </div>
                      @foreach($tech_sups as $center)
                      <a data-id="{{$center->id}}" class="center-item collection-item avatar">
                          <!--[if !IE]> -->
                        <i class="material-icons circle smartbit">location_on</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons circle smartbit">&#xE0C8;</i>
                        <![endif]-->
                          <span class="title">{{$center->nome}}</span>
                          <p>{{$center->indirizzo}} <br>
                             recapito: {{$center->telefono}}
                          </p>
                          <span href="#!" class="secondary-content"><!--[if !IE]> -->
                    <i class="material-icons">add</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons">&#xE145;</i>
                    <![endif]--></span>
                        </a>
                      @endforeach
                      @endif
                  </div>
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
        <!--div class="fixed-action-btn" style="left:23px">
            <a href="{{url('/#del')}}" class="create_repair btn-floating btn-large smartbit">
              <i class="large material-icons">arrow_back</i>
            </a>
        </div-->
</div>
@endif
@endsection