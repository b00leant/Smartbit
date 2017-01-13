@extends('layouts.app')
@section('content')
@if(Auth::check())
<div class="row">
    <div class="col s12">
        <div class="section">
            <div id="rip" class="collection with-header container">
              
            <div class="collection-header">
                <h4>Riparazioni</h4>
                <a class="btn-floating btn waves-effect waves-light smartbit" href="{{ url('select-repair-owner') }}">
                    <i class="material-icons">add</i>
                </a>
            </div>
            @if(isset($repairs_pages))
                @foreach($repairs_pages as $repair)
                    <a href="/repair/{{$repair->id}}" class="collection-item">
                        <div class="secondary-content">
                            @if($repair->stato === 'creata')
                            <i class="material-icons tooltipped" style="color:grey" data-tooltip="Creata">hourglass_empty</i>
                            @elseif($repair->stato === 'iniziata')
                            <i class="material-icons tooltipped" style="color:grey" data-tooltip="Iniziata">done</i>
                            @elseif($repair->stato === 'finita')
                            <i class="material-icons tooltipped" style="color:grey" data-tooltip="Finita (non ancora pronta)">done_all</i>
                            @elseif($repair->stato === 'pronta')
                            <i class="material-icons tooltipped" style="color:#4CAF50" data-tooltip="Pronta per il ritiro">done_all</i>
                            @elseif($repair->stato === 'consegnata')
                            <i class="material-icons tooltipped" style="color:#4CAF50" data-tooltip="Pronta per il ritiro">tag_faces</i>
                            @else
                            <i class="material-icons tooltipped" style="color:grey" data-tooltip="senza stato">error</i>
                            @endif
                        </div>Modello: {{$repair->device->model}} ({{$repair->person_name()}})
                    </a>
                    
                @endforeach
                <ul class="pagination repairs" style="text-align:center">
                    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                    <li class="active"><a href="page=1">1</a></li>
                    @for($i = 1; $i < $repairs_pages->lastPage(); $i++)
                    <li class="waves-effect"><a href="page={{$i+1}}">{{$i+1}}</a></li>
                    @endfor
                    @if($repairs_pages->nextPageUrl() != null)
                        <li class="waves-effect"><a href="page={{$repairs_pages->nextPageUrl() + 2}}"><i class="material-icons">chevron_right</i></a></li>
                    @else
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    @endif
                    </ul>
            @endif
        </div>
            <ul id="del" class="collection with-header container">
            <li class="collection-header">
                <h4>Spedizioni</h4>
                @if(Auth::user()->id === 1 or Auth::user()->id === 2)
                <a href="{{ url('new-pickup') }}" style="margin-top:1em" class="waves-effect waves-light btn"><i class="material-icons left">add</i>Imposta ritiro</a>
                <a href="{{ url('new-delivery') }}" style="margin-top:1em" class="waves-effect waves-light btn"><i class="material-icons left">add</i>Aggiunci Spedizione</a>
                <a href="{{ url('new-tech-sup') }}" style="margin-top:1em" class="waves-effect waves-light btn"><i class="material-icons left">add</i>Aggiunci Centro</a>
                @endif
            </li>
            @if(isset($deliveries))
            @foreach($deliveries as $delivery)
            @if($delivery->stato == 'creata')
            <a href="delivery/{{$delivery->id}}" class="collection-item avatar black-text">
                <span data-badge-caption="" class="new badge">da spedire</span>
                <i class="material-icons circle green">location_on</i>
                <span class="title">{{$delivery->technicalSupport->nome}}</span>
                <p>spedizione: {{$delivery->task_consegna}}
                <br>dispositivi da spedire: {{count($delivery->repairs)}}</p>
                <span href="#!" class="secondary-content"><i class="material-icons"></i></span>
            </a>
            @elseif($delivery->stato == 'da_ritirare')
            <a href="delivery/{{$delivery->id}}" class="collection-item avatar black-text">
                <span data-badge-caption="" class="new badge">da ritirare</span>
                <i class="material-icons circle green">local_shipping</i>
                <span class="title">{{$delivery->technicalSupport->nome}}</span>
                <p>da ritirare il: @if(!isset($delivery->task_ritiro))
                ???
                @endif{{$delivery->task_ritiro}}</p>
                dispositivi da ritirare: {{count($delivery->repairs)}}</p>
                <span href="#!" class="secondary-content"><i class="material-icons"></i></span>
            </a>
            @endif
            @endforeach
            @endif
        </ul>
            <div id="ppl" class="container">
            <nav>
                <div class="nav-wrapper">
                  <form>
                    <div class="input-field">
                      <input id="search" class="autocomplete2show people "  onkeyup="handleCollectionShow();" autocomplete="off" type="search" required>
                      <label for="search"><i class="material-icons">search</i></label>
                      <i class="material-icons" onclick="handleFocusOut();">close</i>
                    </div>
                  </form>
                </div>
            </nav>
            <div class="collection with-header people">
                <div class="collection-header">
                    <h4>Clienti</h4>
                    <a class="btn-floating btn waves-effect waves-light smartbit" href="{{ url('create-person') }}">
                        <i class="material-icons">add</i>
                    </a>
                </div>
                <!--li class="collection-item avatar">
                    <i class="material-icons circle green">perm_identity</i>
                    <span class="title">Pierre il Sultano</span>
                    <p>1 riparazione in corso<br>0 debiti</p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li-->
                @if(isset($people_pages))
                @foreach($people_pages as $person)
                <a href="{{url('person/'.$person->id)}}" class="collection-item avatar">
                    <i class="material-icons circle  amber accent-4">perm_identity</i>
                    <span class="title">{{$person->nome}} {{$person->cognome}}</span>
                    <p>@if(count($person->repairs) ==1)
                    una riparazione
                    @else
                    {{count($person->repairs)}} riparazioni
                    @endif
                    in corso<br>0 debiti</p>
                    <!--a href="/person/{{$person->id}}" class="secondary-content"><i class="material-icons">grade</i></a-->
                </a>
                @endforeach
                <ul class="pagination people" style="text-align:center">
                    <li class="disabled">
                        <a href="#!">
                            <i class="material-icons">chevron_left</i>
                        </a>
                    </li>
                    <li class="active">
                        <a href="page=1">1</a>
                    </li>@for($i = 1; $i < $people_pages->lastPage(); $i++)
                    <li class="waves-effect"><a href="page={{$i+1}}">{{$i+1}}</a></li>
                    @endfor @if($people_pages->nextPageUrl()!=null)
                    <li class="waves-effect">
                        <a href="page={{$people_pages['last_page'] + 2}}">
                            <i class="material-icons">chevron_right</i>
                        </a>
                    </li>
                    @else <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li> @endif
                    </ul>
            @endif
            </div>
        </div>
        </div>
    </div>
</div>
<script>
</script>
@endif
@endsection