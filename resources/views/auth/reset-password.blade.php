@extends('layouts.app')
@section('content')
    <h5 class="mb-3">Login</h5>
    <hr>
    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email')
        is-invalid
    @enderror" id="email"
                placeholder="user@gmail.com" name="email" value="{{ $request->email }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password')
      is-invalid
  @enderror" id="password"
                placeholder="Password" name="password">
        </div>

        <div class="mb-3">
            <label for="confirmedPassword" class="form-label">Confirmed Password</label>
            <input type="password" class="form-control @error('password_confirmation')
      is-invalid
  @enderror"
                id="confirmedPassword" placeholder="Confirmed Password" name="password_confirmation">
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Update Password</button>
        </div>
    </form>
@endsection
