@extends('layouts.app')

@section('content')
@if(Auth::check())

<div class="container">
    <div class="section">
        <form method="POST" action="{{ url('new-repair') }}">
            <button class="insert_person btn-floating waves-effect waves-light right" type="submit" name="action">
                <!--[if !IE]> -->
                    <i class="material-icons right">add</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons right">&#xE145;</i>
                    <![endif]-->
            </button>
            
            <div class="input-field col s12">
                
                    {{ csrf_field() }}
                    <!--[if !IE]> -->
                    <i class="material-icons prefix">textsms</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons prefix">&#xE0D8;</i>
                    <![endif]-->
                    <input type="hidden" name="nome" value="">
                    <input type="hidden" name="cognome" value="">
                    <input type="hidden" name="id" value="">
                    <input type="text" name="nomecompleto" value="" autocomplete="off" id="autocomplete-devices" class="autocomplete people">
                    <label for="autocomplete-devices">Inserisci Intestatario</label>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
