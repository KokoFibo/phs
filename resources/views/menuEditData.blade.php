@extends('layouts.app')
@section('content')
    @livewire('datapelita.editdata', ['current_id' => @intval($id)])
@endsection
