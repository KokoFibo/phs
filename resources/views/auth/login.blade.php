@extends('layouts.app1')
@section('content')
    <section class="flex items-center justify-center min-h-screen bg-gray-50">
        <!-- login container -->
        <div class="flex items-center max-w-3xl p-5 bg-pink-100 shadow-lg rounded-2xl">
            <!-- image -->
            <div class="hidden w-1/2 md:block">
                <img class="rounded-2xl"
                    src="https://images.unsplash.com/photo-1616606103915-dea7be788566?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1887&q=80">
                {{-- <img class="rounded-2xl" src="{{ asset('img/love-corn.avif') }}"> --}}
            </div>
            <!-- form -->
            <div class="px-8 md:w-1/2 md:px-16">
                <h2 class="font-bold text-2xl text-[#002D74]">Login</h2>
                <p class="text-xs mt-4 text-[#002D74]">If you are already a member, easily log in</p>

                <form action="{{ route('login') }}" method="post" class="flex flex-col gap-4 ">
                    @csrf
                    <input class="p-2 mt-8 border rounded-xl" type="email" name="email" placeholder="Email"
                        value="{{ old('email') }}" autocomplete="off">
                    <div class="relative" x-data="{ showPassword: false }">
                        <input class="w-full p-2 border rounded-xl" :type="showPassword ? 'text' : 'password'"
                            name="password" placeholder="Password">

                        <svg @click="showPassword = !showPassword" xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="gray" class="absolute -translate-y-1/2 bi bi-eye top-1/2 right-3"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </div>
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    <button type="submit"
                        class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300 mt-5">Login</button>
                </form>

                <div class="mt-5 text-xs border-b border-[#002D74] py-4 text-[#002D74]">
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </div>

                <div class="mt-3 text-xs flex justify-between items-center text-[#002D74]">
                    <p>Don't have an account?</p>
                    <a href="register"><button
                            class="px-5 py-2 duration-300 bg-white border rounded-xl hover:scale-110">Register</button></a>
                </div>
            </div>
        </div>
    </section>
@endsection
