@extends('layouts.app')
@section('content')
@if(Auth::user()->id ===1 or Auth:user()->id ==2)
<div class="row" style="padding-top:70px">
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
              <div class="container">
                  
                  <form method="POST" id="create" action="{{ url('create-pickup') }}">
                      {{ csrf_field() }}
                      <input type="hidden" value="" name="center">
                  </form>
                  <!-- da impostare la classe "active" per selezionarli -->
                  <div id="technical_supports_select" class="collection with-header">
                      @if(isset($tech_sups))
                      <div class="collection-header">
                          <h4>Seleziona il Centro</h4>
                      </div>
                      @foreach($tech_sups as $center)
                      <a data-id="{{$center->id}}" class="center-item collection-item avatar">
                          <i class="material-icons smartbit circle">location_on</i>
                          <span class="title">{{$center->nome}}</span>
                          <p>{{$center->indirizzo}} <br>
                             recapito: {{$center->telefono}}
                          </p>
                          <span href="#!" class="secondary-content"><i class="material-icons">add</i></span>
                        </a>
                      @endforeach
                      @endif
                  </div>
              </div>
              
        </div>
        <div class="fixed-action-btn">
        <button class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
          <i class="large material-icons">done</i>
        </button>
        </div>
        <!--div class="fixed-action-btn" style="left:23px">
            <a href="{{url('/#del')}}" class="create_repair btn-floating btn-large smartbit">
              <i class="large material-icons">arrow_back</i>
            </a>
        </div-->
</div>
@endif
@endsection