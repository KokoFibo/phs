@extends('layouts.app1')
@section('content')
<section class="flex items-center justify-center min-h-screen bg-gray-50">
      <!-- login container -->
      <div class="flex items-center max-w-3xl p-5 bg-teal-100 shadow-lg rounded-2xl">
            <!-- image -->
            <div class="hidden w-1/2 md:block">
                  <img class="rounded-2xl" src="https://images.unsplash.com/photo-1616606103915-dea7be788566?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1887&q=80">
            </div>
            <!-- form -->
            <div class="px-8 md:w-1/2 md:px-16">
                  <h2 class="font-bold text-2xl text-[#002D74]">Reset Password</h2>
                  <p class="text-xs mt-4 text-[#002D74]">Enter your email address to reset</p>
                  @if (session('status'))
                  <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                        <span class="font-medium">{{ session('status') }}
                  </div>

                  @endif

                  <form action="{{ route('password.request') }}" method="post" class="flex flex-col gap-4 ">
                        @csrf
                        <input class="p-2 mt-8 border rounded-xl" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off">
                        @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300 mt-5">Reset</button>
                  </form>
                  <div class="mt-5 text-xs border-b border-[#002D74] py-4 text-[#002D74]">
                        <a href="login">Ready to login?</a>
                  </div>

                  <div class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
                        <p>Don't have an account?</p>
                        <a href="register"><button class="px-5 py-2 duration-300 bg-white border rounded-xl hover:scale-110">Register</button></a>

                  </div>
            </div>


      </div>
</section>
@endsection
