@extends('layouts.app')

@section('content')
@if(Auth::check())

<div class="container">
    <div class="section">
        <form method="POST" action="{{ url('new-repair') }}">
            <button class="insert_person btn-floating waves-effect waves-light right" type="submit" name="action">
                <i class="material-icons right">add</i>
            </button>
            
            <div class="input-field col s12">
                
                    {{ csrf_field() }}
                    <i class="material-icons prefix">textsms</i>
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
