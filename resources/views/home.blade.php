@extends('layouts.app')

@section('content')
<div style="position:absolute;width:100%;padding-top:90px">
    <div class="fairyoutl " id="open" style="padding:0">
    </div>
    <div class="fairyl " id="open" style="padding:0">
    </div>
    <div class="fairyoutr " id="open" style="padding:0">
    </div><div class="fairyr" id="open" style="padding:0">
    </div>
    <div class="hour-banner" id="open" style="border:0px;background-color: rgb(6, 86, 116);font-size:1em">ORA APERTO</div>
</div>
<div class="home row">
  <div class="col s4">
    <div class="center promo promo-example">
      <i class="material-icons large amber-text text-darken-1">flash_on</i>
      <p class="promo-caption">Servizio efficiente</p>
      <p class="light center">Noi di Smartbit facciamo del nostro meglio per riparare i vostri dispositivi in meno tempo possibile.</p>
    </div>
  </div>
  <div class="col s4">
    <div class="center promo promo-example">
      <i class="material-icons large amber-text text-darken-1">gps_fixed</i>
      <p class="promo-caption">Tracciabilità</p>
      <p class="light center">Grazie al nostro sistema di Tracking sai sempre in che stato si trova la tua riparazione.</p>
    </div>
  </div>
  <div class="col s4">
    <div class="center promo promo-example">
      <i class="material-icons large amber-text text-darken-1">notifications_active</i>
      <p class="promo-caption">Notificato, sempre</p>
      <p class="light center">Con il nostro sistema di notifiche asincrone, email e SMS sei sempre aggiornato.</p>
    </div>
  </div>
</div>

<div class="parallax-container">
  <div class="parallax"><img src="http://wallpaper.pickywallpapers.com/1920x1080/minimal-phone-evolution.jpg"></div>
</div>
@endsection
