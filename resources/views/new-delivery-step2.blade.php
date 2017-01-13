@extends('layouts.app')
@section('content')
@if(Auth::user()->id ===1)
<div class="row" style="padding-top:70px">
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
              <div class="container ">
                  <form method="POST" id="create" action="{{ url('select-repair-delivery') }}">
                      {{ csrf_field() }}
                      <input type="hidden" name="center" value="{{$center}}"/>
                      <input type="hidden" value="" name="json_repairs">
                  </form>
                  <!-- da impostare la classe "active" per selezionarli -->
                  <div id="delivery_select" class="collection with-header">
                      @if(isset($repairs))
                      <div class="collection-header">
                          <h4>Seleziona Le riparazioni</h4>
                      </div>
                      @foreach($repairs as $repair)
                      <a class="delivery-item collection-item" data-id="{{$repair->id}}">{{$repair->device->model}} ({{$repair->person->nome}} {{$repair->person->cognome}})</a>
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
</div>
@endif
@endsection