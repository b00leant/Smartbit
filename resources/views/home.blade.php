@extends('layouts.app')

@section('content')
<div class="row home" style="margin-bottom:0">
    <div style="position:absolute;width:100%;padding-top:90px;z-index:2">
        <div class="fairyoutl " id="open" style="padding:0">
        </div>
        <div class="fairyl " id="open" style="padding:0">
        </div>
        <div class="fairyoutr " id="open" style="padding:0">
        </div><div class="fairyr" id="open" style="padding:0">
        </div>
        <div class="hour-banner white-text" id="open" style="
        border:0px;background-color: rgb(6, 86, 116);font-size:1.5em">Benvenuto</div>
    </div>
    <div id="maphome" style="height: 500px; width: 100%; position: relative;"></div>
</div>
@endsection