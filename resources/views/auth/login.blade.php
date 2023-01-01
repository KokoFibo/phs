@extends('layouts.app1')
@section('content')
    <div class="container">
        <div class="col-4 mt-5 mx-auto  p-3 shadow-lg rounded-5" style="border-radius: 15px">

            <h5 class="mb-3 col-3 ">Login</h5>
            <hr>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email')
            is-invalid
        @enderror"
                        id="email" placeholder="user@gmail.com" name="email" value="{{ old('email') }}">
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
        @enderror"
                        id="password" placeholder="Password" name="password">
                </div>



                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
            <hr>
            <div class="d-flex justify-content-between">

                <a href="{{ route('password.request') }}">Forget Password</a>
                <a href="register">Create New Account</a>
            </div>
        </div>
    </div>
@endsection
