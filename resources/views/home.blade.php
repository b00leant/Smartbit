@extends('layouts.app')

@section('content')


<!--div id="fb-root"></div-->
<div class="row home" style="margin-bottom:0;padding-top:56px">
    <div class="col s12 l6" style="padding:0">
        <div class="hide welcome-banner col s12 l6" style="padding:0;position:absolute;margin-top:90px;z-index:2">
    <div class="fairyoutl " id="open" style="padding:0">
    </div>
    <div class="fairyl " id="open" style="padding:0">
    </div>
    <div class="fairyoutr " id="open" style="padding:0">
    </div><div class="fairyr" id="open" style="padding:0">
    </div>
    <div class=" hour-banner white-text" id="open" style="
    border:0px;background-color: rgb(6, 86, 116);font-size:1.5em">Siamo aperti!</div>
</div>
        <div id="maphome" style="width:100%;height: 525px; position: relative;"></div>
    </div>
    <div style="height:525px;background-color:#074b65;text-align: center;padding: 15px 10px 0px 10px" class="col s12 l6 ">
        
        <div class="fb-loader-container valign-wrapper" style="
    height:inherit;">
            <div style="margin:auto" class="center fb-page-loader preloader-wrapper big active">
              <div style="text-align:center;">
                  <div class="spinner-layer spinner-smartbit2-only">
                    <div class="circle-clipper left">
                      <div class="circle"></div>
                    </div><div class="gap-patch">
                      <div class="circle"></div>
                    </div><div class="circle-clipper right">
                      <div class="circle"></div>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <div  class="fb-page" 
        data-href="https://www.facebook.com/smartbitsrl/"
        data-tabs="timeline" 
        data-small-header="false" 
        data-adapt-container-width="true" 
        data-hide-cover="true" 
        data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/smartbitsrl/" 
            class="fb-xfbml-parse-ignore">
                <a class="hide" href="https://www.facebook.com/smartbitsrl/">SmartBit</a></blockquote>
        </div>
    </div>
</div>
@endsection