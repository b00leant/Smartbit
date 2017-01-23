@extends('layouts.app')

@section('content')
{{-- <div id="fb-root"></div> --}}
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v2.8&appId=1696543827255530";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div class="row home" style="margin-bottom:0;padding-top:56px">
    <div class="col s12 l8" style="padding:0">
        <div class="hide welcome-banner col s12 l8" style="padding:0;position:absolute;margin-top:90px;z-index:2">
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
    <div style="text-align:center;padding-top:15px;padding-bottom:10px" class="grey darken-3 col s12 l4">
        <div class="fb-page" 
        data-href="https://www.facebook.com/smartbitsrl/" 
        data-tabs="timeline" 
        data-small-header="false" 
        data-adapt-container-width="true" 
        data-hide-cover="true" 
        data-show-facepile="true">
            <blockquote cite="https://www.facebook.com/smartbitsrl/" 
            class="fb-xfbml-parse-ignore">
                <a href="https://www.facebook.com/smartbitsrl/">SmartBit</a></blockquote>
        </div>
    </div>
</div>
@endsection