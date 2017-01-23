<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <html itemscope itemtype="http://schema.org/LocalBusiness">

    <!-- Aggiungi i tre tag seguenti all'interno del tag head. -->
    <meta itemprop="name" content="SmartBit">
    <meta itemprop="description" content="SmartBit è un&#39;azienda specializzata nella vendita e assistenza di prodotti nel campo della telefonia mobile e dell&#39;informatica. SmartBit inoltre mette a disposizione operazioni di notifica e tracking online per la clientela che richiede i nostri servizi di assistenza tecnica">
    <meta itemprop="image" content="http://smartbit.online/favicon.ico">
    
    <!-- for Facebook -->          
    <meta property="og:title" content="SmartBit" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="http://smartbit.online" />
    <meta property="og:url" content="http://smartbit.online/" />
    <meta property="og:description" content="SmartBit è un'azienda specializzata nella vendita e riparaz.." />

    <!-- for Twitter -->          
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="SmartBit" />
    <meta name="twitter:description" content="SmartBit è un'azienda specializzata nella vendita e riparaz.." />
    <meta name="twitter:image" content="{{ asset('images/favicon.ico') }}" />
    
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/Icon-60@3x.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/Icon-76.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/Icon-76@2x.png') }}" />
    <link rel="apple-touch-icon" sizes="58x58" href="{{ asset('images/Icon-Small@2x.png') }}" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>SmartBit</title>

    <!-- Fonts -->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous"-->
    <link rel="stylesheet" src="{{ asset('css/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700"-->

    <!-- Styles -->
    <style type="text/css">
        a[href^="http://maps.google.com/maps"]{display:none !important}
        a[href^="https://maps.google.com/maps"]{display:none !important}
        
        .gmnoprint a, .gmnoprint span, .gm-style-cc {
            display:none;
        }
        .gmnoprint div {
            background:none !important;
        }
    </style>
    <!--Import Google Icon Font-->
    <!--link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"-->
    <!--Import materialize.css-->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"-->
    <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/smartbit.css') }}">
    <style type="text/css">
        @font-face {
          font-family: 'Material Icons';
          font-style: normal;
          font-weight: 400;
          src: url("{{asset('iconfont/MaterialIcons-Regular.eot')}}"); /* For IE6-8 */
          src: local('Material Icons'),
               local('MaterialIcons-Regular'),
               url("{{asset('iconfont/MaterialIcons-Regular.woff2')}}") format('woff2'),
               url("{{asset('iconfont/MaterialIcons-Regular.woff')}}") format('woff'),
               url("{{asset('iconfont/MaterialIcons-Regular.ttf')}}") format('truetype');
        }
    
    .material-icons {
      font-family: 'Material Icons';
      font-weight: normal;
      font-style: normal;
      font-size: 24px;  /* Preferred icon size */
      display: inline-block;
      line-height: 1;
      text-transform: none;
      letter-spacing: normal;
      word-wrap: normal;
      white-space: nowrap;
      direction: ltr;
    
      /* Support for all WebKit browsers. */
      -webkit-font-smoothing: antialiased;
      /* Support for Safari and Chrome. */
      text-rendering: optimizeLegibility;
    
      /* Support for Firefox. */
      -moz-osx-font-smoothing: grayscale;
    
      /* Support for IE. */
      font-feature-settings: 'liga';
    }
    </style>
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <header>
    {{------------------- DEFINISCO NAVIGAZIONE PER GLI OSPITI ---------------}}
    @if(Auth::guest())
    <nav class="z-depth-1" style="position:fixed;z-index:4;">
    <div class="nav-wrapper">
        <a href="/" class="brand-logo center">Smart<span class="brand-logo-part">BIT</span></a>
    </div>
</nav>
    {{------------------ DEFINISCO NAVIGAZIONE NEL LABORATORIO ---------------}}
    @elseif(Route::getCurrentRoute()->getPath() == 'lab')
    <nav class="z-depth-1" style="background:#ffab00;position:fixed;z-index:4;">
        <div class="nav-wrapper">
            <ul class="left">
                <a href="#" data-activates="slide-out" class="sbmenu" 
                style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                    <!--[if !IE]> -->
                    <i class="material-icons">menu</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons">&#xE5D2;</i>
                    <![endif]-->
                </a>
                <li class="hide-on-small-only">
                        <a href="{{url('/home')}}">
                            <!--[if !IE]> -->
                            <i class="material-icons">home</i>
                            <!-- <![endif]-->
                            <!--[if lt IE 9]>
                            <i class="material-icons">&#xE88A;</i>
                            <![endif]-->
                        </a>
                </li>
                <li class="hide-on-small-only">
                    <a href="{{url('/home#del')}}">
                        <!--[if !IE]> -->
                        <i class="material-icons">local_shipping</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE558;</i>
                        <![endif]-->
                    </a>
                </li>
            </ul>
            <ul class="right">
                <a href="#" class="" 
                style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                    <!--[if !IE]> -->
                        <i class="material-icons">notifications</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE7F4;</i>
                        <![endif]-->
                </a>
            </ul>
            <a href="{{url('/lab')}}" class="brand-logo center">SmartLAB</a>
        </div>
    </nav>
    {{------------------ DEFINISCO NAVIGAZIONE NEL LATO ADMIN ----------------}}
    @elseif(Route::getCurrentRoute()->getPath() != 'home')
    <nav class="z-depth-1" style="position:fixed;z-index:4;">
            <div class="nav-wrapper">
                <ul class="left">
                    <li><a class="sbmenu" style="height: 64px;line-height: 64px;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;" data-activates="slide-out">
                            <!--[if !IE]> -->
                            <i class="material-icons">menu</i>
                            <!-- <![endif]-->
                            <!--[if lt IE 9]>
                            <i class="material-icons">&#xE5D2;</i>
                            <![endif]-->
                        </a></li>
                    <li class="hide-on-small-only">
                        <a href="{{url('/home')}}">
                            <!--[if !IE]> -->
                            <i class="material-icons">home</i>
                            <!-- <![endif]-->
                            <!--[if lt IE 9]>
                            <i class="material-icons">&#xE88A;</i>
                            <![endif]-->
                        </a>
                    </li>
                    <li class="hide-on-small-only">
                        <a href="{{url('/home#del')}}">
                            <!--[if !IE]> -->
                            <i class="material-icons">local_shipping</i>
                            <!-- <![endif]-->
                            <!--[if lt IE 9]>
                            <i class="material-icons">&#xE558;</i>
                            <![endif]-->
                        </a>
                    </li>
                </ul>
                
                <a href="/" class="brand-logo center">Smart<span class="brand-logo-part">BIT</span></a>
            </div>
        </nav>
    {{------------------ DEFINISCO NAVIGAZIONE NELLA HOME ADMIN -------------}}
    @else
    <nav class="z-depth-1 nav-extended" style="position:fixed;z-index:4;">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo center">Smart<span class="brand-logo-part">BIT</span></a>
                <ul class="left">
                    <a href="#" data-activates="slide-out" class="sbmenu" 
                    style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                        <!--[if !IE]> -->
                        <i class="material-icons">menu</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE5D2;</i>
                        <![endif]-->
                    </a>
                </ul>
                <ul class="tabs tabs-transparent" style="overflow-x:hidden">
                    <li class="tab"><a href="#rip">Riparazioni</a></li>
                    <li class="tab"><a href="#del">Spedizioni</a></li>
                    <li class="tab"><a href="#ppl">Clienti</a></li>
                </ul>
            </div>
            
        </nav>
    {{------------------------------- FINE NAVIGAZIONE -----------------------}}
    @endif
    @if(Auth::check() and Route::getCurrentRoute()->getPath() == 'lab')
    <!--ul id="slide-lab" class="side-nav">
      <li><a href="#!">First Sidebar Link</a></li>
      <li><a href="#!">Second Sidebar Link</a></li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">First</a></li>
                <li><a href="#!">Second</a></li>
                <li><a href="#!">Third</a></li>
                <li><a href="#!">Fourth</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
    </ul-->
    <div id="slide-lab" class="row side-nav" style="width:100%">
        <nav class="z-depth-1 amber accent-4" style="position:fixed;z-index:4;">
            <div class="nav-wrapper">
                <ul class="left">
                    <a class="hide-slide-lab" 
                    style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                        <!--[if !IE]> -->
                        <i class="material-icons white-text">arrow_back</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons white-text">&#xE5C4;</i>
                        <![endif]-->
                    </a>
                </ul>
                <h3  class="brand-logo center">Info</h3>
            </div>
        </nav>
        <div class="row" style="padding-top:64px;text-align:center;">
            <div class="section" style="padding-bottom:0;">
                <div class="hide preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
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
            <div class="hide progress" style="margin:0;height:0.5em">
                <div class="indeterminate"></div>
            </div>
            <div class="section info_owner col s12 m6">
                <div class="container">
                    <h4 class="smartbit-text" style="padding:0.5em;color:white;text-align:center">
                        <!--[if !IE]> -->
                        <i class="material-icons">perm_identity</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE8A6;</i>
                        <![endif]-->
                    </h4>
                    <div class="divider"></div>
                    <p class="repair_info_nome">Nome: </p>
                    <div class="divider"></div>
                    <p class="repair_info_cognome">Cognome:</p>
                    <div class="divider"></div>
                    <p class="repair_info_tel">Telefono: </p>
                    <div class="divider"></div>
                </div>
            </div>
            <div class="section info_device col s12 m6">
                <div class="container">
                    <h4 class="smartbit-text" style="padding:0.5em;color:white;text-align:center">
                        <!--[if !IE]> -->
                        <i class="material-icons">phone_iphone</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE325;</i>
                        <![endif]-->
                    </h4>
                    <div class="divider"></div>
                    <p class="repair_info_modello">Modello:</p>
                    <div class="divider"></div>
                    <p class="repair_info_marca">Marca: </p>
                    <div class="divider"></div>
                    <p class="repair_info_imei">Stato: </p>
                    <div class="divider"></div>
                </div>
            </div>
            <div class="section note_rip col s12">
                <div class="section">
                    <div class="input-field col note-field1 s12">
                        <!--[if !IE]> -->
                        <i class="material-icons">info_outline</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE88F;</i>
                        <![endif]-->
                        <textarea readonly id="icon_prefix2" class="materialize-textarea"></textarea>
                        <label class="active" for="icon_prefix2">Dettagli</label>
                    </div>
                </div>
            </div>
            <div class="section note_lab col s12">
                <div class="section">
                    <input type="hidden" name="id_rip"/>
                    <div class="hide note-field input-field col s12">
                        <!--[if !IE]> -->
                        <i class="material-icons">mode_edit</i>
                        <!-- <![endif]-->
                        <!--[if lt IE 9]>
                        <i class="material-icons">&#xE254;</i>
                        <![endif]-->
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Note</label>
                    </div>
                </div>
            </div>
            
              <input type="hidden" name="change-state" class="change-state-lab" value="null">
            <div class="section col s12" style="padding:0em;text-align:center">
                <button class="btn change-state-lab waves-effect hide waves-light smartbit" onclick="change_state();">
                </button>
                <button data-target="modal-change" class="btn hide finish-state-lab waves-effect waves-light smartbit">Finisci
                    <!--[if !IE]> -->
                    <i class="material-icons">send</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons">&#xE163;</i>
                    <![endif]-->
                </button>
                <button data-target="modal-deliverable" class="btn hide deliverable-lab waves-effect waves-light smartbit">Spedisci
                    <!--[if !IE]> -->
                    <i class="material-icons">local_shipping</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons">&#xE558;</i>
                    <![endif]-->
                </button>
                <button class="btn hide update-lab waves-effect waves-light smartbit" onclick="update_lab();">Salva
                    <!--[if !IE]> -->
                    <i class="material-icons">save</i>
                    <!-- <![endif]-->
                    <!--[if lt IE 9]>
                    <i class="material-icons">&#xE161;</i>
                    <![endif]-->
                </button>
            </div>
        </div>
        
    </div>
    @endif
    @if(!Auth::guest())
    <ul id="slide-out" class="side-nav">
            <li><div class="userView">
          <div class="background">
            <img src="http://sf.co.ua/16/01/wallpaper-5da9.jpg">
          </div>
          @if(Auth::user()->id == 5)
          <a href="#!user"><img class="circle" src="{{url('bubblegum.png')}}"></a>
          @else
          <a href="#!user"><img class="circle" src="{{url('grumpy.jpeg')}}"></a>
          @endif
          <a href="#!name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
          <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
          <a href="{{url('logout')}}"><span class="white-text email">
            <!--[if !IE]> -->
            <i class="material-icons">exit_to_app</i>
            <!-- <![endif]-->
            <!--[if lt IE 9]>
            <i class="material-icons">&#xE879;</i>
            <![endif]-->
            </span></a>
        </div></li>
        @if(Route::getCurrentRoute()->getPath() != 'home')
        <li><a class="waves-effect" href="{{url('/home')}}">
            <!--[if !IE]> -->
            <i class="material-icons">home</i>
            <!-- <![endif]-->
            <!--[if lt IE 9]>
            <i class="material-icons">&#xE88A;</i>
            <![endif]-->
        Torna a Smartbit</a></li>
        @endif
        @if(Auth::user()->id == 1 or Auth::user()->id == 2)
        @if(Route::getCurrentRoute()->getPath() != 'home')
        @endif
        @if(Route::getCurrentRoute()->getPath() != 'lab')
        
        <li><a class="waves-effect" href="{{url('/lab')}}">
            <!--[if !IE]> -->
            <i class="material-icons">build</i>
            <!-- <![endif]-->
            <!--[if lt IE 9]>
            <i class="material-icons">&#xE869;</i>
            <![endif]-->
            Vai al laboratorio</a></li>
        @else
        <li><a class="waves-effect" href="#{{url('/home')}}">
            <!--[if !IE]> -->
            <i class="material-icons">assignment_turned_in</i>
            <!-- <![endif]-->
            <!--[if lt IE 9]>
            <i class="material-icons">&#xE862;</i>
            <![endif]-->
            Pianificazioni</a></li>
        <li><a class="waves-effect" href="#{{url('/home')}}">
            <!--[if !IE]> -->
            <i class="material-icons">memory</i>
            <!-- <![endif]-->
            <!--[if lt IE 9]>
            <i class="material-icons">&#xE322;</i>
            <![endif]-->
            Magazzino pezzi</a></li>
        @endif
        {{-- <li><a class="waves-effect" href="{{url('deliveries')}}">
            <!--[if !IE]> -->
            <i class="material-icons">local_shipping</i>
            <!-- <![endif]-->
            <!--[if lt IE 9]>
            <i class="material-icons">&#xE558;</i>
            <![endif]-->
            Vai alle consegne</a></li> --}}
        @endif
        

        {{-- <li><div class="divider"></div></li>
        <li><a class="subheader">Altro</a></li>
        <li><a class="waves-effect" href="#!">Cose secondarie..</a></li> --}}
        </ul>
    @endif
    </header>
    <main>

    @yield('content')

    <!--Import jQuery before materialize.js-->
    <!--script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script-->
    <script src="{{ asset('js/jquery/jquery-2.1.1.js') }}"></script>
    <!--script src="//cdnjs.cloudflare.com/ajax/libs/coffee-script/1.7.1/coffee-script.min.js"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script--> 
    <script src="{{ asset('js/modernizr/modernizr.js') }}"></script>
    <!-- Compiled and minified JavaScript -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script-->
    <!-- JavaScripts -->
    <script src="{{ asset('js/bin/materialize.js') }}"></script>
    
    
    
    @if(Route::getCurrentRoute()->getPath() === '/')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAK6y8tZ4VlyEKfCUzV7LvxTNLN6Me6S8&libraries=places"></script>
    <!--script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAK6y8tZ4VlyEKfCUzV7LvxTNLN6Me6S8&callback=autocompleteAddress">
    </script-->
    
    <script>
    autocompleteAddress();
    function autocompleteAddress(){
        var position = new google.maps.LatLng(41.775432,12.924108);
        var map = new google.maps.Map(document.getElementById('maphome'), {
          scrollwheel: false,
          navigationControl: false,
          mapTypeControl: false,
          scaleControl: false,
          draggable: false,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          zoom: 14,
          center: position,
          disableDefaultUI: true,
          
          /*styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{
                  "featureType": 'poi.business',
                  "stylers": [{"visibility": 'off'}]
                },{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"landscape.man_made","elementType":"labels.text","stylers":[{"visibility":"off"},{"weight":"2.82"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]*/
          /*styles:[
              {"featureType":"all",
                "elementType":"geometry",
                "stylers":[{"color":"#ffffff"}]},{
                  "featureType": 'poi.business',
                  "stylers": [{"visibility": 'off'}]
                },
                {"featureType":"all","elementType":"labels.text.fill","stylers":[{"gamma":0.01},{"lightness":20}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"saturation":-31},{"lightness":-33},{"weight":2},{"gamma":0.8}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#050505"}]},{"featureType":"administrative.locality","elementType":"labels.text.stroke","stylers":[{"color":"#fef3f3"},{"weight":"3.01"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#0a0a0a"},{"visibility":"off"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.stroke","stylers":[{"color":"#fffbfb"},{"weight":"3.01"},{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":30},{"saturation":30}]},{"featureType":"poi","elementType":"geometry","stylers":[{"saturation":20}]},{"featureType":"poi.attraction","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"lightness":20},{"saturation":-20}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":10},{"saturation":-30}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"saturation":25},{"lightness":25}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#a1a1a1"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#292929"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#202020"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"simplified"},{"hue":"#0006ff"},{"saturation":"-100"},{"lightness":"13"},{"gamma":"0.00"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#686868"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"visibility":"off"},{"color":"#8d8d8d"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#353535"},{"lightness":"6"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":"3.45"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#d0d0d0"}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"lightness":"2"},{"visibility":"on"},{"color":"#999898"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#383838"}]},{"featureType":"road.local","elementType":"labels.text.stroke","stylers":[{"color":"#faf8f8"}]},{"featureType":"water","elementType":"all","stylers":[{"lightness":-20}]}]*/
          /*styles: [
                {elementType: 'geometry', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.stroke', stylers: [{color: '#a1887f'}]},
                {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                {
                  featureType: 'administrative.locality',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.business',
                  stylers: [{visibility: 'off'}]
                },
                {
                  featureType: 'poi',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#212121'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'geometry',
                  stylers: [{color: '#263c3f'}]
                },
                {
                  featureType: 'poi.park',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#6b9a76'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry',
                  stylers: [{color: '#38414e'}]
                },
                {
                  featureType: 'road',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#212a37'}]
                },
                {
                  featureType: 'road',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#9ca5b3'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry',
                  stylers: [{color: '#746855'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'geometry.stroke',
                  stylers: [{color: '#1f2835'}]
                },
                {
                  featureType: 'road.highway',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#f3d19c'}]
                },
                {
                  featureType: 'transit',
                  elementType: 'geometry',
                  stylers: [{color: '#2f3948'}]
                },
                {
                  featureType: 'transit.station',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#d59563'}]
                },
                {
                  featureType: 'water',
                  elementType: 'geometry',
                  stylers: [{color: '#17263c'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.fill',
                  stylers: [{color: '#515c6d'}]
                },
                {
                  featureType: 'water',
                  elementType: 'labels.text.stroke',
                  stylers: [{color: '#17263c'}]
                }]*/
            styles:[{
            "featureType": "transit",
            "stylers": [
              { "visibility": "off" }
            ]
          },{
                  "featureType": 'poi.business',
                  "elementType": "labels",
                  "stylers": [{"visibility": 'off'}]
                },{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#ffab00"},{"weight":"0.30"},{"saturation":"-75"},{"lightness":"5"},{"gamma":"1"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#ffab00"},{"saturation":"-75"},{"lightness":"5"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#085674"},{"visibility":"on"},{"weight":"6"},{"saturation":"-28"},{"lightness":"0"}]},{"featureType":"administrative","elementType":"labels.icon","stylers":[{"visibility":"on"},{"color":"#e6007e"},{"weight":"1"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#085674"},{"saturation":"-28"},{"lightness":"0"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"color":"#ffab00"},{"visibility":"simplified"},{"saturation":"-75"},{"lightness":"5"},{"gamma":"1"}]},{"featureType":"road","elementType":"labels.text","stylers":[{"visibility":"on"},{"color":"#085674"},{"weight":8},{"saturation":"-28"},{"lightness":"0"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#ffab00"},{"weight":8},{"lightness":"5"},{"gamma":"1"},{"saturation":"-75"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"color":"#ffab00"},{"saturation":"-75"},{"lightness":"5"},{"gamma":"1"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffab00"},{"saturation":"-75"},{"lightness":"5"},{"gamma":"1"}]},{"featureType":"water","elementType":"labels.text","stylers":[{"visibility":"simplified"},{"color":"#085674"},{"saturation":"-28"},{"lightness":"0"}]},{"featureType":"water","elementType":"labels.icon","stylers":[{"visibility":"off"}]}]
            
        });
        var request = {
          placeId: 'ChIJKUz510t8JRMRVPfw2-GzWHM'
        };
        
        var service = new google.maps.places.PlacesService(map);
        service.getDetails(request, callback);
        
        function callback(place, status) {
          if (status == google.maps.places.PlacesServiceStatus.OK) {
              console.log(place);
              if(!place.opening_hours.open_now){
                  $('.welcome-banner div').each(function(){
                    $('#open').attr("id","close");
                    $('.hour-banner').addClass("red");
                    $('.hour-banner').text("Siamo chiusi");
                  });
              }
              $('.welcome-banner').removeClass('hide');
            //createMarker(place);
          }
        }
        var image = {
          url: 'http://www.smartbit.online/images/smartbit_marker.png',
          scaledSize: new google.maps.Size(80, 80),
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(40, 80) // anchor
        };
        
        var marker = new google.maps.Marker({
          icon: image,
          position: position,
          map: map,
          url: 'https://www.google.it/maps/place/SmartBit+srl/@41.7754322,12.9219192,17z/data=!4m13!1m7!3m6!1s0x13257c4bd7fa4e6b:0x4f05bd31eb2115e3!2sVia+Casilina,+343,+00038+Valmontone+RM!3b1!8m2!3d41.7754322!4d12.9241079!3m4!1s0x13257c4bd7f94c29:0x7358b3e1dbf0f754!8m2!3d41.7754322!4d12.9241079'
        });
        google.maps.event.addDomListener(window, "resize", function() {
         var center = map.getCenter();
         google.maps.event.trigger(map, "resize");
         map.setCenter(center); 
        });
        google.maps.event.addListener(marker, 'click', function() {
          //window.location.href = marker.url;
          window.open(marker.url,'_blank');
        });
}
    </script>
    @elseif(Route::getCurrentRoute()->getPath() === 'create-person' or Route::getCurrentRoute()->getPath() === 'add-person' or Route::getCurrentRoute()->getPath() === 'new-tech-sup')
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAK6y8tZ4VlyEKfCUzV7LvxTNLN6Me6S8&callback=autocompleteAddress">
    </script>
    <script>
        function autocompleteAddress(){
        $('input#addr_complete.autocomplete.address').searchAddress();
    }
    </script>
    @endif
    <script src="{{ asset('js/sbaddress.js') }}"></script>
    <script src="{{ asset('js/edit_delivery.js') }}"></script>
    <script src="{{ asset('js/edit_backdelivery.js') }}"></script>
    <script src="{{ asset('js/sbscripts.js') }}"></script>
    <script src="{{ asset('js/autocompleteRepairs.js') }}"></script>
    <!--script src="{{ asset('js/html2canvas.js') }}"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script-->
    <script src="{{ asset('js/jspdf/dist/jspdf.debug.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script src="{{ asset('js/JsBarcode.all.min.js') }}"></script>
    @if(Route::getCurrentRoute()->getPath() === 'lab')
    <script src="{{ asset('js/labIE.js') }}"></script>
    @endif
    <script src="{{ asset('js/sbpdf.js') }}"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script-->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    
    
    <script>
        /*$(document.body).on('click', 'a.lab-item' ,function(){
            
        });*/
 		$(document).ready(function(){
            
 		    //autocompleteModels();
 		    @if(Auth::check())
            autocompletePeople();
            autocompleteRepairs();
 		    @endif
 		    
 		    lastEvent = void 0;

            heldKeys = {};
            
            window.onkeydown = function(event) {
                event = event || window.event; //IE does not pass the event object
                if (lastEvent && lastEvent.keyCode === event.keyCode) {
                    return;
                }
                lastEvent = event;
                heldKeys[event.keyCode] = true;
            
                var keyCode = event.which || event.keyCode; //key property also different
            
                switch (keyCode) {
                    case 80:
                        return myamp.userInput("positiv");
                    case 81:
                        return myamp.userInput("negativ");
                }
            };
            
            window.onkeyup = function(event) {
                event = event || window.event;
                lastEvent = null;
                return delete heldKeys[event.keyCode];
            };
 		    
 		    $('.date_delivery').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15 // Creates a dropdown of 15 years to control year
              });
 		    $('.center-item').on('click',function(){
                $('.center-item').each(function(){
                    $(this).removeClass('active');
                    $(this).removeClass('white-text');
                });
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                    $(this).removeClass('white-text');
                    $('form#create input[name="center"]').val('');
                }else{
                    $(this).addClass('active');
                    $(this).addClass('white-text');
                    $('form#create input[name="center"]').val($(this).data('id'));
                }
            });
            $('.delivery-item').on('click',function(){
                var json_repairs = $('form#create input[name="json_repairs"]').val();
                if(json_repairs!=''){
                    json_repairs = JSON.parse(json_repairs);
                }else{
                    json_repairs = new Object();
                }
                if($(this).hasClass('active')){
                    $(this).removeClass('active');
                    $(this).removeClass('white-text');
                    delete json_repairs[$(this).data('id')];
                    json_repairs = JSON.stringify(json_repairs);
                    $('form#create input[name="json_repairs"]').val(json_repairs);
                }else{
                    $(this).addClass('active');
                    json_repairs[$(this).data('id')] = $(this).data('id');
                    json_repairs = JSON.stringify(json_repairs);
                    $(this).addClass('white-text');
                    $('form#create input[name="json_repairs"]').val(json_repairs);
                }
                console.log(json_repairs);
            });
            
 		    $('.hide-slide-lab').on('click',function(){
 		        $(this).sideNav('hide');
 		        $('div#slide-lab.side-nav').animate({ left: '100%'}, 'slow');//.css('left','100%');
 		    });
 		    $('.tooltipped').tooltip({delay: 50});
            $('.lab-item').on('click',function(){
                load_repair_info($(this).data('id'));
                $('div#slide-lab.side-nav').css('left','0%');
            });
 		    $('.lab-item:not(.updated)').sideNav({
                  menuWidth: '100%', // Default is 240
                  edge: 'right', // Choose the horizontal origin
                  closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                  draggable: false // Choose whether you can drag to open on touch screens
                });
 		    $("ul.tabs li.tab a").click(function(e) {
                window.location.hash = $(this).attr("href").split('#')[1];
                e.preventDefault();
            });
 		    $(document).on('click', 'ul.pagination.repairs li a', function (e) {
 		        if($(this).attr('href')!='#!'){
 		            getRepairs($(this).attr('href').split('page=')[1]);
 		            e.preventDefault();
 	        }
 	        });
 	        $(document).on('click', 'ul.pagination.people li a', function (e) {
 		        if($(this).attr('href')!='#!'){
 		            getPeople($(this).attr('href').split('page=')[1]);
 		            e.preventDefault();
 	        }
 	        });
 	        $(document).on('click', 'a.refresh-lab', function (e) {
 		        if($(this).attr('href')!='#!'){
 		            getLab($(this).attr('href').split('page=')[1]);
 		            e.preventDefault();
 	        }
 	        });
 		    $(window).keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                }
            });
            
            
            
            
            $(document).ready(function(){
              $('.parallax').parallax();
            })
            $('.modal').modal();
            $('.modal_giveback').modal();
            $('.modal_delete').modal();
            $('.back-delivery-center').modal();
            $('.edit-delivery-center').modal();
            $('.edit-delivery-repair').modal();
            function remove_map_icon(){
              //$('input.autocomplete.address').closest('i').hide();
              //$('div#map').hide();
            }
            $('input.autocomplete.address').focusin(function(){
                $('div#map').show();
            });
 			$('input#autocomplete-input').keyup(function(){
 			    $('.input-field div .progress').removeClass('hide');  
            });
   			// Activate the side menu 
   			//$(".button-collapse").sideNav();
   			$(".sbmenu").sideNav();
  	    });
    </script>
</main>
@if(Route::getCurrentRoute()->getPath() === '/')
<footer class="page-footer" style="position:relative;
    width: 100%;
    bottom: 0;margin-top:0;padding-top:1em;border-top: solid 0.5em #ffb300">
    <div class="container">
        <div class="home row">
  <div class="col s12 m4">
    <div class="center promo promo-example">
      <!--[if !IE]> -->
      <i class="material-icons large amber-text text-darken-1">flash_on</i>
      <!-- <![endif]-->
      <!--[if lt IE 9]>
      <i class="material-icons large amber-text text-darken-1">&#xE3E7;</i>
      <![endif]-->
      <p class="white-text promo-caption">Servizio efficiente</p>
      <p class="white-text light center">Noi di Smartbit facciamo del nostro meglio per riparare i vostri dispositivi in meno tempo possibile.</p>
    </div>
  </div>
  <div class="col s12 m4">
    <div class="center promo promo-example">
      <!--[if !IE]> -->
      <i class="material-icons large amber-text text-darken-1">remove_red_eye</i>
      <!-- <![endif]-->
      <!--[if lt IE 9]>
      <i class="material-icons large amber-text text-darken-1">&#xE417;</i>
      <![endif]-->{{-- gps_fixed --}}
      <p class="white-text promo-caption">Tracciabilità</p>
      <p class="white-text light center">Grazie al nostro sistema di Tracking sai sempre in che stato si trova la tua riparazione.</p>
    </div>
  </div>
  <div class="col s12 m4">
    <div class="center promo promo-example">
      <!--[if !IE]> -->
      <i class="material-icons large amber-text text-darken-1">notifications_active</i>
      <!-- <![endif]-->
      <!--[if lt IE 9]>
      <i class="material-icons large amber-text text-darken-1">&#xE7F7;</i>
      <![endif]-->
      <p class="white-text promo-caption">Notificato, sempre</p>
      <p class="white-text light center">Con il nostro sistema di notifiche asincrone, email e SMS sei sempre aggiornato.</p>
    </div>
  </div>
</div>
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">WebApp in via di sviluppo</h5>
                <p class="grey-text text-lighten-4">A breve saremo disponibili per aiutarvi!</p>
            </div>
            <!--div class="col l4 offset-l2 s12" style="text-align:center">
                <h5 style="color:white">Votaci su Google+</h5>
                <i class="material-icons large" style="color:white">phone_android</i>
            </div-->
       </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
    © 2017 Stefano Latini
    <!--a class="grey-text text-lighten-4 right" href="#!">More Links</a-->
        </div>
    </div>
    
</footer>
@endif
</body>
</html>
