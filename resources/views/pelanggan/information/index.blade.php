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
<h1 class="text-xl font-bold">Laporkan Kendala Jaringan</h1>
<form action="/pelanggan/information/report" method="POST">
    @csrf
    <div class="md:mx-4 my-4">
        <div class="md:w-1/2  space-y-4">
            <div class="flex justify-between items-center space-x-4 box-border">
                <label for="">Kendala </label>
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
                <label for="">Kendala </label>
                <p>:</p>
                <div class="w-10/12">
                    <textarea name="detail" class="w-full rounded-md block @error(" detail") border-red-500 @enderror""
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
