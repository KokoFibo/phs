@extends('layouts.app')
@section('content')
    <h5 class="mb-3">Reset Password</h5>
    <hr>


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('password.request') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email')
            is-invalid
        @enderror" id="email"
                placeholder="user@gmail.com" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Reset</button>
        </div>
    </form>
@endsection
