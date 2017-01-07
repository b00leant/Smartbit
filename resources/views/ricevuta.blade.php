@extends('layouts.pdf')
@section('content')
@if(Auth::check())
<h1 style="padding:1em;color:white;background:#085674;text-align:center">Ricevuta riparazione Smartbit SRL</h1><br>

<div style="width:50%;margin-left:25%;text-align:center">
<img style="padding:0.2em" src="{{resource_path('images/ic.png')}}">
<div style="padding:0%;margin:0 0% 0 0%;text-align:center;border:2px solid #085674">
    <p>Modello: {{$repair->device->model}}</p>
    <p>Marca: {{$repair->device->brand}}</p>
    <p>Imei: {{$repair->device->imei}}</p>
</div>
</div>
<div style="width:50%;margin-left:25%;text-align:center">
    <img style="padding:0.2em" src="{{resource_path('images/ip.png')}}">
    <div style="padding:0%;margin:0 0% 0 0%;text-align:center;border:2px solid #085674">
        <p>Nome: {{$repair->person->nome}}</p>
        <p>Cognome: {{$repair->person->cognome}}</p>
        <p>Data di nascita: {{$repair->person->data_nascita}}</p>
        <p>Telefono: {{$repair->person->telefono}}</p>
    </div>
</div>
</div>
<div style="width:100%;text-align:center;">
    <img style="padding:0.2em" src="{{resource_path('images/id.png')}}">
</div>
<div style="width:50%;margin-left:25%;padding-top:0.2em;text-align:center;border:2px solid #085674">
    <p>{{$repair->note}}</p>
</div>
<div style="width:100%;text-align:center;font-size:0.9em">
    <h5>Termini e consizioni</h5>
    <p>
        1. Il cliente è pregato di ritirare il dispositivo riparato entro un massimo di 6 mesi (180 giorni) che verranno contati a partire dal giorno dell'avvenuta riparazione. Passati 180 giorni la presente ricevuta non sarà più valida
    </p>
    <p>
        2. la garanzia è di soli 3 mesi (90 giorni) che verranno contati a partire dal giorno dell'eventuale riparazione del cellulare e copre solamente il guasto riparato. Dopo il ritiro del dispositivo non si assume alcuna responsabilità per eventuali problemi che dovessero insorgere
    </p>
    <p>
        3. Si prega di rimuovere (se il dispositivo ne è munito o ne permette l'alloggiamento) sim-card e memory-card
    </p>
    <p>
        4. I dati del dispositivo devono essere trascritti, poichè c'è il rischio che durante la riparazione essi possano essere cancellati
    </p>
    <p>
        5. Si prega di provare subito il dispositivo per controllare se funziona, in caso contrario decade la garanzia
    </p>
    <p>
        6. Si autorizza il trattamento dei dati personali in base art. 13 del D. Lgs. 196/2003.
    </p>
    <br>
    <p>Firma __________________</p>
    <br><br>
    <span>
        Smartbit S.R.L. Via Casilina 343 Valmontone (RM) Tel.06/95995061 
        <br>
        Grazie per aver scelto smartbit! Puoi tenere sotto controllo la riparazione inserendo il seriale nella pagina riportata dal 
        <br>
        linkwww.microtelservice.it/tracking
    </span>
</div>
<br><br>
<h2 style="width:100%;padding:0.1em;text-align:center">
    SERIALE: {{$repair->seriale}}
</h2>
<div style="position:relative;text-align:center">
    <img src="data:image/png;base64,{{$barcode64}}" alt="barcode"/>
</div>
@endif
@endsection