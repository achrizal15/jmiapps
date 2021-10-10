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
<h1 class="text-xl font-bold">Formulir Pembayaran Bulanan Pelanggan</h1>
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="md:w-1/2 w-full space-y-4 my-4">
        <div class="grid grid-cols-6 text-gray-700 items-center grid-flow-col justify-items-stretch">
            <div class="w-full"><label for="nama-pelanggan">Nama</label></div>
            <div class="justify-self-center">:</div>
            <div class="col-span-4"><input type="text" disabled id="nama-pelanggan" value="{{ auth()->user()->name }}"
                    class="py-0.5 w-full bg-gray-100"></div>
        </div>

        <div class="grid grid-cols-6 text-gray-700 items-center grid-flow-col justify-items-stretch">
            <div class="w-full"><label for="paket-pelanggan">Paket</label></div>
            <div class="justify-self-center">:</div>
            <div class="col-span-4">
                <input type="text" disabled id="paket-pelanggan" value="{{ $myPackage["package_name"] }}"
                    class="py-0.5 w-full bg-gray-100">
            </div>
        </div>
        <div class="grid grid-cols-6 text-gray-700 items-center grid-flow-col justify-items-stretch">
            <div class="w-full"><label for="paket-pelanggan">Tagihan</label></div>
            <div class="justify-self-center">:</div>
            <div class="col-span-4">
                <input type="text" disabled id="paket-pelanggan" value="@rupiah($myPackage["tagihan"])"
                    class="py-0.5 w-full bg-gray-100 focus:border-gray-500 focus:ring-0">
                <input type="text" name="tagihan" readonly hidden id="paket-pelanggan" value="{{ $myPackage["tagihan"] }}"
                    class="py-0.5 w-full bg-gray-100 focus:border-gray-500 focus:ring-0">
            </div>
        </div>
        <div>
            <div class="grid grid-cols-6 text-gray-700 items-center grid-flow-col justify-items-stretch">
                <div class="w-full"><label for="paket-pelanggan">Upload Bukti Transfer</label></div>
                <div class="justify-self-center">:</div>
                <div class="col-span-4">
                    <input type="file" name="transfer_img" id="paket-pelanggan" required
                        class="py-0.5 w-full bg-white shadow-md border focus:outline-none">
                </div>
            </div>
            @error('transfer_img')
            <div class="grid grid-cols-6 text-gray-700 items-center grid-flow-col justify-items-stretch">
                <span class="col-start-3 col-span-4 font-extralight text-red-500">{{ $message }}</span>
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success hover:bg-green-600">Kirim Pembayaran</button>
    </div>
</form>

<div class="overflow-x-auto">
    <table class="table w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Paket</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transfer as $tf)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ date("d-M-Y", strtotime($tf->created_at)) }}</td>
                <td>{{ $tf->installations->package->name }}</td>
                <td>@rupiah($tf->installations->package->price)/Bulan</td>
                <td>
                    <div class="has-tooltip inline-block">@if ($tf->status=="pending")
                        <span class="tooltip rounded-sm shadow-lg p-0.5 bg-gray-100 -mt-8 text-xs">
                            Pembayaran anda belum diacc admin!
                        </span>
                        @endif
                        <x-tables.status sts="{{$tf->status}}" />
                    </div>
                </td>
                <td>
                    <label for="my-modal-2" id="img-src" data-img="{{ $tf->transfer_img }}" class="modal-button">
                        <div class=" rounded-full overflow-hidden w-10 h-10">
                            <img src="{{ asset('storage/'.$tf->transfer_img) }}" alt="tf">
                        </div>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<input type="checkbox" id="my-modal-2" class="modal-toggle">
<div class="modal">
    <div class="modal-box">
        <div class="flex justify-center">
            <img class="h-72" id="modal-img" alt="tf">
        </div>
        <div class="modal-action">
            <label for="my-modal-2" class="btn">Close</label>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $(document).on("click","#img-src", function () {
            let data = $(this).data("img")
           $("#modal-img").attr("src", `{{ asset('storage/${data}') }}`);
        });
    });
</script>
@endsection
