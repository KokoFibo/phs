@extends('layouts.guest')
@section('title', 'Welcome')
@section('content')
    <div class="flex justify-between px-10 mx-auto">
        <div class="mt-10">
            <h1 class="text-5xl font-bold z-1">Vihara Pelita Hati</h1>
            <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex, dolorem.</p>
        </div>
        <div class="flex gap-4 mt-10">
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    </div>

@endsection
