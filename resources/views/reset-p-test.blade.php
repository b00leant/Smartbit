@extends('layouts.app')
@section('content')
@if(Auth::check())
{{ csrf_field }}
<a class="test-reset-p">ESSO</a>
@endif
@endsection('content')