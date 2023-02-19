@extends('layouts.app2')
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
{{-- login --}}

<div class="container-fluid bground">


      {{-- <div class="mx-auto mt-3 card col-4"> --}}
      <div class=" col-4">
            {{-- <div class="text-center border rounded card-header">
                Login
            </div> --}}
            {{-- <div class="card-body"> --}}
            <div class="p-3 m-5 mx-auto glass">

                  <h5 class="mb-3 text-center text-white">Password Reseto</h5>
                  <hr>
                  @if (session('status'))
                  <div class="alert alert-success">
                        {{ session('status') }}
                  </div>
                  @endif

                  {{-- form --}}

                  <form action="{{ route('password.request') }}" method="post">
                        @csrf
                        <div class="mb-3">
                              <label for="email" class="form-label">Email</label>
                              <input type="text" class="form-control @error('email')
                        is-invalid
                    @enderror" id="email" placeholder="user@gmail.com" name="email" value="{{ old('email') }}">
                              @error('email')
                              <div class="invalid-feedback">
                                    {{ $message }}
                              </div>
                              @enderror
                        </div>
                        <div class="mb-3">
                              <button class="btnrev btn btn-primary" type="submit">Reset</button>
                        </div>
                  </form>
                  {{-- form end --}}

                  <hr>
                  <div class="d-flex justify-content-between">

                        <a href="/">Login</a>
                        <a href="register">Create New Account</a>
                  </div>
            </div>
            {{-- </div> --}}
      </div>
</div>
{{-- login end --}}
@endsection
