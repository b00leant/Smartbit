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
      <p class="promo-caption">Speeds up development</p>
      <p class="light center">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components.</p>
    </div>
  </div>
  <div class="col s4">
    <div class="center promo promo-example">
      <i class="material-icons large amber-text text-darken-1">gps_fixed</i>
      <p class="promo-caption">User Experience Focused</p>
      <p class="light center">By utilizing elements and principles of Material Design, we were able to create a framework that focuses on User Experience.</p>
    </div>
  </div>
  <div class="col s4">
    <div class="center promo promo-example">
      <i class="material-icons large amber-text text-darken-1">notifications_active</i>
      <p class="promo-caption">Easy to work with</p>
      <p class="light center">We have provided detailed documentation as well as specific code examples to help new users get started.</p>
    </div>
  </div>
</div>

<div class="parallax-container">
  <div class="parallax"><img src="http://wallpaper.pickywallpapers.com/1920x1080/minimal-phone-evolution.jpg"></div>
</div>
@endsection
