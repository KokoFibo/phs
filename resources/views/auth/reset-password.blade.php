@extends('layouts.app1')
@section('content')
    <style>
        .bground {
            background: rgb(140, 151, 255);
            background: linear-gradient(157deg, rgba(140, 151, 255, 1) 0%, rgba(255, 185, 250, 1) 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .glass {
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btnrev {
            background-color: transparent;
            border-color: blue;
            color: blue;
        }
    </style>
    <div class="container-fluid bground">
        <div class="p-3 m-5 mx-auto col-4 glass">


            <h5 class="mb-3 text-center text-white">Login</h5>
            <hr>
            <form action="{{ route('password.update') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email')
        is-invalid
    @enderror"
                        id="email" placeholder="user@gmail.com" name="email" value="{{ $request->email }}">
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
        </div>

    </div>
@endsection
