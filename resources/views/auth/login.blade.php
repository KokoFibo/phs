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

        .main {
            width: 100%;
            /* background: url({{ asset('img/background-biru.jpg') }}); */
            /* background: url({{ asset('img/wallpaper.jpg') }}); */
            background-image: url('https://source.unsplash.com/1920x1080?nature');
            background-position: center;
            background-size: cover;
            height: 100vh;
            position: fixed;
        }

        .info {
            padding: 30px;
            margin: auto;
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

        .parent {
            display: flex;
            height: 100vh;
        }

        .btnrev {
            background-color: transparent;
            border-color: blue;
            color: blue;
        }
    </style>
    {{-- <div class="container-fluid bground"> --}}
    <div class="main">
        <div class="parent">

            <div class="info glass col-4">
                {{-- <div class="col-4"> --}}

                {{-- <div class="p-3 m-5 mx-auto glass"> --}}

                <h5 class="mb-3 text-center text-white">Login</h5>
                <hr>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="text-white form-label">Email</label>
                        <input type="text" class="form-control @error('email')
            is-invalid
        @enderror"
                            placeholder="user@gmail.com" name="email" value="{{ old('email') }}" autocomplete="off">
                        {{-- placeholder="user@gmail.com" name="email" value="{{ old('email') }}"> --}}
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="text-white form-label">Password</label>
                        <input type="password"
                            class="form-control @error('password')
            is-invalid
        @enderror"
                            placeholder="Password" name="password" autocomplete="off">
                    </div>



                    <div class="mb-3">
                        <button class="btnrev btn btn-primary" type="submit">Login</button>
                    </div>
                </form>
                <hr>
                <div class="d-flex justify-content-between">

                    <a href="{{ route('password.request') }}">Forget Password</a>
                    <a href="register">Create New Account</a>
                </div>
            </div>
            {{-- </div> --}}
        </div>
        {{-- </div> --}}
    </div>
@endsection
