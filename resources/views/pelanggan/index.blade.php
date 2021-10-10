@extends('templates.member')
@section('content')

@if (session("success"))
    <x-alert type="success">
        {{session('success')}}
    </x-alert>
@endif
@if (session("error"))
    <x-alert type="error">
        {{session('error')}}
    </x-alert>
@endif
<h1 class="block text-center text-gray-600 font-bold text-lg">DAFTAR PAKET</h1>
<hr class="border-b-2 border-gray-400 mb-8 mt-1">
<div class="carousel carousel-center rounded-box space-x-2 px-4 py-4 shadow-inner">
    @foreach ($packages as $item)
    <div class="carousel-item">
        <div class="w-64 md:w-80 h-80 shadow-md border-gray-500 border rounded-md relative overflow-y-hidden">
            <div class="p-4 block">
                <div class="flex justify-between mb-4">
                    <h3 class="font-medium tracking-wide">{{ $item->name }}</h3>
                    <h3 class="font-medium tracking-wide">@rupiah($item->price)</h3>
                </div>
                <div class="overflow-y-hidden capitalize text-gray-600">
                    <ul class="list-disc list-inside p-1">
                        @foreach (explode(',',$item->feature) as $f)
                        <li>{{ $f }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-4 flex space-x-1 text-gray-600">
                    <span class="">NOTE</span>
                    <p class="">:{{ $item->note }}</p>
                </div>
            </div>
            <form action="/pelanggan/dashboard" method="post">
                @csrf
                <input type="text" hidden name="package_id" value="{{ $item->id }}">
                @if ($hasPackage)
                <button disabled class="w-full py-2 bg-gray-500 absolute bottom-0 text-white hover:bg-gray-600
                ">
                    SUDAH MEMILIH PAKET
                </button>
                @else
                <button type="submit" class="w-full py-2 bg-gray-700 absolute bottom-0 text-white hover:bg-gray-600
                " onclick="return confirm('Apakah anda yakin akan membeli paket ini?')">
                    @rupiah($item->price)
                </button>@endif

            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
