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
    <div class="w-full flex flex-wrap font-family-karla">
        <!-- Register Section -->
        <div class="w-full md:w-1/2 flex flex-col">
            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-12">
                <img class="w-24 lg:w-28 md:w-20 " src="/img/logo-jmi.png" alt="">
            </div>
    
            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Join Us.</p>
                <form action="/register" method="POST" class="flex flex-col pt-3 md:pt-8">
                    {{--  onsubmit="event.preventDefault();" --}}
                    @csrf
                    <div class="flex flex-col pt-4">
                        <label for="name" class="text-lg">Name</label>
                        <input type="text" value="{{ old('name') }}" name="name" id="name" placeholder="John Smith"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                            @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
    
                    <div class="flex flex-col pt-4">
                        <label for="email" class="text-lg">Email <span class="text-sm">(Opsional)</span></label>
                        <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="your@email.com"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                        @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col pt-4">
                        <label for="alamat" class="text-lg">Alamat</label>
                        <input type="text" value="{{ old('alamat') }}" name="alamat" id="alamat" placeholder="jl.new york"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                        @error('alamat')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="flex flex-col pt-4">
                        <label for="phone" class="text-lg">Phone</label>
                        <input type="text" value="{{ old('phone') }}" name="phone" id="phone" placeholder="0822273xxxx"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                            @error('phone')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
    
                    <div class="flex flex-col pt-4">
                        <label for="password" class="text-lg">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                            @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
    
                    <div class="flex flex-col pt-4">
                        <label for="confirm-password" class="text-lg">Confirm Password</label>
                        <input type="password" name="re-password" id="confirm-password" placeholder="Password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                            @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                            @enderror
                    </div>
    
                    <button type="submit"
                        class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">Register</button>
                </form>
                <div class="text-center pt-12 pb-12">
                    <p>Already have an account? <a href="/login" class="underline font-semibold">Log in here.</a></p>
                </div>
            </div>
    
        </div>
    
        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl fixed right-0">
            <img class="object-cover w-full h-screen hidden md:block" src="/img/login-banner.jpg" alt="Background" />
        </div>
    </div>
</body>
@endsection