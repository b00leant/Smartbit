<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!--meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, user-scalable=no' name='viewport' /-->
    <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>SmartBit</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css"-->
    <link rel="stylesheet" href="{{ asset('css/materialize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/smartbit.css') }}">
    
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
    <header>
    {{------------------- DEFINISCO NAVIGAZIONE PER GLI OSPITI ---------------}}
    @if(Auth::guest())
    <nav class="z-depth-1" style="position:fixed;z-index:2;">
    <div class="nav-wrapper">
        <a href="/" class="brand-logo center" style="
            left: 0;
            padding-left: 0.5em;
            transform: translateX(0px);
        ">Smartbit</a>
    </div>
</nav>
    {{------------------ DEFINISCO NAVIGAZIONE NEL LABORATORIO ---------------}}
    @elseif(Route::getCurrentRoute()->getPath() == 'lab')
    <nav class="z-depth-1" style="background:#ffab00;position:fixed;z-index:2;">
        <div class="nav-wrapper">
            <ul class="left">
                <a href="#" data-activates="slide-out" class="sbmenu" 
                style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                    <i class="material-icons">menu</i>
                </a>
            </ul>
            <ul class="right">
                <a href="#" class="" 
                style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                    <i class="material-icons">notifications</i>
                </a>
            </ul>
            <a href="{{url('/lab')}}" class="brand-logo center">SmartLAB</a>
            <!--a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a-->
        </div>
    </nav>
    {{------------------ DEFINISCO NAVIGAZIONE NEL LATO ADMIN ----------------}}
    @elseif(Route::getCurrentRoute()->getPath() != '/')
    <nav class="z-depth-1" style="position:fixed;z-index:2;">
            <div class="nav-wrapper">
                <ul class="left">
                    <li><a class="sbmenu" style="height: 64px;line-height: 64px;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;" data-activates="slide-out"><i class="material-icons">menu</i></a></li>
                </ul>
                <a href="/" class="brand-logo center">Smartbit</a>
                <!--a href="#" data-activates="slide-out"><i class="material-icons">menu</i></a-->
            </div>
        </nav>
    {{------------------ DEFINISCO NAVIGAZIONE NELLA HOME ADMIN -------------}}
    @else
    <nav class="z-depth-1 nav-extended" style="position:fixed;z-index:2;">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo center">Smartbit</a>
                <ul class="left">
                    <a href="#" data-activates="slide-out" class="sbmenu" 
                    style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                        <i class="material-icons">menu</i>
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
    <div id="slide-lab" class="row side-nav">
        <nav class="z-depth-1 amber accent-4" style="position:fixed;z-index:2;">
            <div class="nav-wrapper">
                <ul class="left">
                    <a class="hide-slide-lab" 
                    style="height:64px;line-height:64px:margin;float: left;position: relative;z-index: 1;height: auto;margin: 0 0px;">
                        <i class="material-icons white-text">arrow_back</i>
                    </a>
                </ul>
                <h3  class="brand-logo center">Info</h3>
            </div>
        </nav>
        <div class="row" style="padding-top:64px;text-align:center;">
            <div class="section">
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
                        <i class="medium material-icons">perm_identity</i>
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
                        <i class="medium material-icons">phone_iphone</i>
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
                        <i class="material-icons prefix">info_outline</i>
                        <textarea readonly id="icon_prefix2" class="materialize-textarea"></textarea>
                        <label class="active" for="icon_prefix2">Dettagli</label>
                    </div>
                </div>
            </div>
            <div class="section note_lab col s12">
                <div class="section">
                    <input type="hidden" name="id_rip"/>
                    <div class="hide note-field input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Note</label>
                    </div>
                </div>
            </div>
            
              <input type="hidden" name="change-state" class="change-state-lab" value="null">
            <div class="section col s12" style="padding:1em;text-align:center">
                <button class="btn change-state-lab waves-effect hide waves-light smartbit" onclick="change_state();">
                </button>
                <button data-target="modal-change" class="btn hide finish-state-lab waves-effect waves-light smartbit">Finisci
                    <i class="material-icons right">send</i>
                </button>
                <button class="btn hide update-lab waves-effect waves-light smartbit" onclick="update_lab();">Salva
                    <i class="material-icons right">save</i>
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
          <a href="#!user"><img class="circle" src="{{url('grumpy.jpeg')}}"></a>
          <a href="#!name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
          <a href="#!email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
          <a href="{{url('logout')}}"><span class="white-text email"><i class="material-icons">exit_to_app</i></span></a>
        </div></li>
        @if(Route::getCurrentRoute()->getPath() != '/')
        <li><a class="waves-effect" href="{{url('/')}}"><i class="material-icons">home</i>Torna a Smartbit</a></li>
        @endif
        @if(Auth::user()->id == 1)
        @if(Route::getCurrentRoute()->getPath() != '/')
        @endif
        @if(Route::getCurrentRoute()->getPath() != 'lab')
        
        <li><a class="waves-effect" href="{{url('/lab')}}"><i class="material-icons">build</i>Vai al laboratorio</a></li>
        @else
        <!--li><a class="waves-effect" href="{{url('/')}}"><i class="material-icons">home</i>Torna a Smartbit</a></li-->
        <li><a class="waves-effect" href="#{{url('/')}}"><i class="material-icons">assignment_turned_in</i>Pianificazioni</a></li>
        <li><a class="waves-effect" href="#{{url('/')}}"><i class="material-icons">memory</i>Magazzino pezzi</a></li>
        @endif
        {{-- <li><a class="waves-effect" href="{{url('deliveries')}}"><i class="material-icons">local_shipping</i>Vai alle consegne</a></li> --}}
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script-->
    <!-- JavaScripts -->
    <script src="{{ asset('js/bin/materialize.js') }}"></script>
    <script src="{{ asset('js/sbscripts.js') }}"></script>
    <script src="{{ asset('js/sbaddress.js') }}"></script>
    
    <script src="{{ asset('js/edit_delivery.js') }}"></script>
    <script src="{{ asset('js/edit_backdelivery.js') }}"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAK6y8tZ4VlyEKfCUzV7LvxTNLN6Me6S8&callback=autocompleteAddress">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script src="{{ asset('js/JsBarcode.all.min.js') }}"></script>
    
    <script src="{{ asset('js/sbpdf.js') }}"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script-->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script-->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    
    
    <script>
        /*$(document.body).on('click', 'a.lab-item' ,function(){
            
        });*/
 		$(document).ready(function(){
 		    
 		    
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
 		    $('.hide-side-lab').on('click',function(){
 		        $(this).sideNav('hide');
 		    });
 		    $('.tooltipped').tooltip({delay: 50});
            $('.lab-item').on('click',function(){
                load_repair_info($(this).data('id'));
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
            autocompleteModels();
            autocompletePeople();
            //autocompleteParts();
            $(document).ready(function(){
              $('.parallax').parallax();
            })
            $('.modal').modal();
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
@if(Auth::guest())
<footer class="page-footer" style="position:relative;
    width: 100%;
    bottom: 0;margin-top:0;padding-top:0;">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">WebApp in via di sviluppo</h5>
                <p class="grey-text text-lighten-4">A breve saremo disponibili per aiuarvi!</p>
            </div>
            <!--div class="col l4 offset-l2 s12" style="text-align:center">
                <h5 style="color:white">Votaci su Google+</h5>
                <i class="material-icons large" style="color:white">phone_android</i>
            </div-->
       </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
    © 2016 Stefano Latini
    <!--a class="grey-text text-lighten-4 right" href="#!">More Links</a-->
        </div>
    </div>
</footer>
@endif
</body>
</html>
