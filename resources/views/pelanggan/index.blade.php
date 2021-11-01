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
<p class="hidden">test</p>
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
<h1 class="block text-center text-gray-600 font-bold text-lg mt-20">Laporkan Kendala Jaringan</h1>
<hr class="border-b-2 border-gray-400 mb-8 mt-1">
<form action="/pelanggan/dashboard/report" method="POST">
    @csrf
    <div class="md:mx-4 my-4">
        <div class="md:w-1/2  space-y-4">
            <div class="flex justify-between items-center space-x-4 box-border">
                <label for="">Kendala</label>
                <p>:</p>
                <div class="w-10/12">
                    <select name="constraint" class="w-full rounded-md @error("constraint") border-red-500 @enderror">
                        <option selected disabled hidden>Pilih kendala</option>
                        <option>No internet access</option>
                        <option>Kabel Putus</option>
                        <option>Modem Rusak</option>
                        <option>Lain-lain</option>
                    </select>
                    @error("constraint")
                    <span class="font-light text-red-500">{{ $message }}</span>       @enderror
                </div>

            </div>
            <div class="flex justify-between items-center space-x-4 box-border">
                <label for="">Detail </label>
                <p>:</p>
                <div class="w-10/12">
                    <textarea name="detail" class="w-full rounded-md block @error("detail") border-red-500 @enderror"
                        placeholder="Ceritakan kendala yang anda alami!"></textarea>
                    @error("detail")
                    <span class="font-light text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="py-1 px-4 bg-gray-600 text-white rounded transition hover:bg-gray-500 duration-200"> Laporkan
            </button>
        </div>
    </div>
    </div>
</form>
@endsection
