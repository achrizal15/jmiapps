@extends('templates.member')
@section('content')

    @if (session('success'))
        <x-alert type="success">
            {{ session('success') }}
        </x-alert>
    @endif
    @if (session('error'))
        <x-alert type="error">
            {{ session('error') }}
        </x-alert>
    @endif
    <h1 class="block text-center text-gray-600 font-bold text-lg">DAFTAR PAKET</h1>
    <hr class="border-b-2 border-gray-400 mb-8 mt-1">
    <div class="flex flex-wrap justify-center">
        @foreach ($packages as $key => $item)
            <?php
            $gradient = 'from-gray-700 to-gray-500';
            $warna = 'gray';
            if (intval($item->price) > 200000 && intval($item->price) < 700000) {
                $gradient = 'from-rose-700 to-rose-500';
                $warna = 'rose';
            } elseif (intval($item->price) > 700000 && intval($item->price) < 800000) {
                $gradient = 'from-violet-700 to-violet-500';
                $warna = 'violet';
            } elseif (intval($item->price) > 800000) {
                $gradient = 'from-yellow-700 to-yellow-500';
                $warna = 'yellow';
            }
            ?>
            <div
                class="w-96 bg-white shadow-2xl mt-4 @if ($key + (1 % 3) != 0)  mr-4           
                @endif flex flex-col justify-center rounded-sm">
                <div class="bg-gradient-to-bl {{ $gradient }} p-5 text-center text-white uppercase font-bold">
                    {{ $item->name }}
                </div>
                <div class="text-center font-bold bg-{{ $warna }}-500 text-white p-5">
                    <h3 class="pb-5 uppercase">{{ $item->note }}</h3>
                    <div class="pb-5">
                        <span class="align-top inline-block ">Rp.</span>
                        <span class="align-bottom text-3xl inline-block ">@rupiah($item->price)</span>
                        <span class="align-middle inline-block ">/Bulan</span>
                    </div>
                </div>
                <div class="py-10 h-80 text-center">
                    <ul>
                        @foreach (explode(',', $item->feature) as $k => $f)
                            <li
                                class="@if ($k % 2 == 0)
                                bg-gray-100
                            @endif p-2">
                                {{ $f }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="p-10 text-center uppercase">
                    <form action="/pelanggan/dashboard" method="post">
                        @csrf
                        <input type="text" hidden name="package_id" value="{{ $item->id }}">
                    <button @if ($hasPackage) disabled @endif type="submit"
                        class="p-2 bg-{{ $warna }}-600 @if ($hasPackage) cursor-not-allowed @endif text-white font-bold hover:shadow-gray-500 shadow-md rounded-sm">@if ($hasPackage) SUDAH MEMILIH PAKET @else ORDER @endif </button>
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
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">KENDALA</span>
                    </label>
                    <select name="constraint" class="form-select my-input @error('constraint') border-red-500 @enderror">
                        <option selected disabled hidden>Pilih kendala</option>
                        <option>No internet access</option>
                        <option>Kabel Putus</option>
                        <option>Modem Rusak</option>
                        <option>Lain-lain</option>
                    </select>
                    @error('constraint')
                    <span class="font-light text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">DETAIL</span>
                    </label>
                    <textarea name="detail"
                        class="form-textarea my-input @error('detail') border-red-500 @enderror"></textarea>
                    @error('detail')
                    <span class="font-light text-red-500">{{ $message }}</span> @enderror
                </div>



                <button type="submit"
                    class="py-1 px-4 bg-gray-600 text-white rounded transition hover:bg-gray-500 duration-200"> Laporkan
                </button>
            </div>
        </div>
        </div>
    </form>
@endsection
