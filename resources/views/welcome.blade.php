@extends('layouts.guest')
@section('title', 'Welcome')
@section('content')


    {{-- @if (Auth::user()->role == 0) --}}
    <h1>anda adalah admin</h1>
    <h1>Harap hubungi supervisor atau manager anda utk aktifasi</h1>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
        @csrf
    </form>
    {{-- @else --}}



@endsection
