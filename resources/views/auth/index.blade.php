@extends('templates.main')
@section('style')
<style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
        font-family: karla;
    }
</style>
@endsection
@section('content')
<body>
    <div class="w-full flex flex-wrap ">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <img class="w-24 lg:w-28 md:w-20 " src="/img/logo-jmi.png" alt="">
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl pb-3 md:pb-8">Welcome.</p>
                @if(session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
                @endif
                @if(session('loginError'))
                <x-alert type="error">
                    {{ session('loginError') }}
                </x-alert>
                @endif
                <form class="flex flex-col" method="POST" action="/login">
                    @csrf
                    <div class="flex flex-col pt-4">
                        <label for="phone" class="text-lg">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="085244XXX"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                        @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col pt-4">
                        <label for="password" class="text-lg">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                        @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="submit" value="Log In"
                        class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">
                </form>
                <div class="text-center pt-12 pb-12">
                    <p>Don't have an account? <a href="/register" class="underline font-semibold">Register here.</a>
                    </p>
                </div>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover  w-full h-screen hidden md:block" src="/img/login-banner.jpg">
        </div>
    </div>
</body>
@endsection
