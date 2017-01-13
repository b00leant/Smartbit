@extends('layouts.app')
@section('content')
@if(Auth::user()->id ===1 or Auth::user()->id ===2)
<div class="row" style="padding-top:70px">
    <form method="POST" id="create" action="{{ url('select-repair-delivery') }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="center" value="{{$center}}"/>
                      <input type="hidden" value="" name="json_repairs">
                  
        <div class="col s12">
            <nav>
                <div class="nav-wrapper">
                    <div class="col s12">
                        <a href="{{url()->previous()}}" class="breadcrumb active">Centro</a>
                        <a class="breadcrumb">Riparazioni</a>
                        <!--a class="breadcrumb">Data</a-->
                    </div>
                </div>
              </nav>
              <div class="container" style="margin-top:20px">
                  
                  <!-- da impostare la classe "active" per selezionarli -->
                  <div id="delivery_select" class="collection with-header">
                      @if(isset($repairs))
                      @if(count($repairs))
                      <div class="collection-header">
                          <h4>Seleziona Le riparazioni</h4>
                      </div>
                      @foreach($repairs as $repair)
                      <a class="delivery-item collection-item" data-id="{{$repair->id}}">{{$repair->device->model}} ({{$repair->person->nome}} {{$repair->person->cognome}})</a>
                      @endforeach
                      @else
                      <div class="collection-header">
                          <h4>Non ci sono riparazioni da spedire</h4>
                      </div>
                      @endif
                      @endif
                  </div>
              </div>
              
        </div>
        @if(count($repairs))
        <div class="fixed-action-btn">
        <button class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
          <i class="large material-icons">done</i>
        </button>
        </div>
        @else
        <div class="fixed-action-btn" style="left:23px">
        <a href="{{url('/#del')}}" class="create_repair btn-floating btn-large smartbit" type="submit" form="create">
          <i class="large material-icons">arrow_back</i>
        </a>
        </div>
        @endif
        </form>
</div>
@endif
@endsection