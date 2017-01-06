@extends('layouts.app')

@section('menutabs')

@if(Auth::guest())
<nav class="z-depth-1">
    <div class="nav-wrapper">
        <a href="/" class="brand-logo center">Smartbit</a>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
@elseif(Auth::check() and Request::url() == '/insert-repair-client')
<nav class="z-depth-1 nav-extended">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo center">Smartbit</a>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        </div>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <a href="#!name"><span class="name">{{ Auth::user()->name }}</span></a>
                </div>
            </li>
        </ul>
    </nav>
@else
<nav class="z-depth-1 nav-extended">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo center">Smartbit</a>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="tabs tabs-transparent" style="overflow-x:hidden">
                <li class="tab"><a href="#rip">Riparazioni</a></li>
                <li class="tab"><a href="#del">Spedizioni</a></li>
                <li class="tab"><a href="#ppl">Clienti</a></li>
            </ul>
        </div>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <a href="#!name"><span class="name">{{ Auth::user()->name }}</span></a>
                </div>
            </li>
        </ul>
    </nav>
@endif
@endsection