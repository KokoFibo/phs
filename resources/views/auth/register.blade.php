@extends('layouts.app1')
@section('content')
    <div class="container">
        <div class="col-4 mt-5 mx-auto  p-3 shadow-lg rounded-5" style="border-radius: 15px">
            <h5 class="mb-3">Registration</h5>
            <hr>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name')
        is-invalid
    @enderror" id="name"
                        placeholder="Full Name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

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

                <div class="mb-3 ">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </form>
            <hr>
            <div class="d-flex ">
                <p class="me-2 mr-2">Already have an account?</p>
                <a href="login"> Login</a>
            </div>
        </div>
    </div>
@endsection
