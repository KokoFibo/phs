@extends('layouts.app')
@section('content')
    <h1>Selamat Datang {{ Auth::user()->name }}</h1>

    <div class="nav-link" id="nav-bar-logoutbutton">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-secondary btn-sm" type="submit">Logout</button>
        </form>
    </div>
@endsection
