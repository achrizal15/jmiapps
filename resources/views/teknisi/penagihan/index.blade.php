@extends('templates.teknisi')
@section('content')
<section class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="w-full mb-12 px-4 mt-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
            @if (session("success"))
            <div class="p-4" id="alert">
                <x-alert type="success">
                    {{session('success')}}
                </x-alert>
            </div>
            @endif
            @if (session("error"))
            <div class="p-4" id="alert">
                <x-alert type="error">
                    {{session('error')}}
                </x-alert>
            </div>
            @endif
            @if ($errors->any())
            <div class="p-4" id="alert">
                <x-alert type="error">
                    Gagal! silahkan coba lagi.
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </x-alert>
            </div>
            @endif

            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="relative w-full  max-w-full flex-grow flex-1 flex">
                        <h3 class="font-semibold text-lg text-gray-700 inline">
                            Daftar {{ $title }}
                        </h3>
                    </div>
                </div>

            </div>
            <div class="block w-full">
                <!-- Projects table -->

                <table class="table table-datatable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pelanggan</th>
                            <th>Blok</th>
                            <th>Paket</th>
                            <th>Expired</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihan as $p )
                        <tr>
                            <td class="">{{ $loop->iteration }}</td>
                            <td>
                                {{ $p->user->name }}
                            </td>
                            <td>{{ $p->bloks->name }}</td>
                            <td>{{ $p->package->name }}</td>
                            <td>{{ $p->expired }}</td>
                            <td>
                                <button onclick="modal_toggler('show-modal')" data-user="{{ $p->user }}" id="btn-show"
                                    class="my-btn-sm bg-blue-500 hover:bg-blue-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a class="my-btn-sm bg-green-500 inline-block hover:bg-green-600"
                                    href="/teknisi/installation/<?=$p->id?>/edit"><i class="fas fa-money-bill-wave"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('templates.footer')
    <div id="show-modal" class="modal">
        <div class="modal-box">
            <img src="https://picsum.photos/id/1005/100/100" class="mask mask-hexagon">
            <div class="grid md:grid-cols-2 md:gap-4">
                <table class="table-show-member">
                    <tr>
                        <td class="w-12">Nama</td>
                        <td>:</td>
                        <td id="name">Windah Basudara</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td id="phone">082123412</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td id="email">windah@gmail.com</td>
                    </tr>
                </table>
                <table class="table-show-member">
                    <tr>
                        <td class="w-12">Alamat</td>
                        <td >:</td>
                        <td id="address">Jakarta</td>
                    </tr>
                    <tr>
                        <td >Maps</td>
                        <td >:</td>
                        <td id="maps">CUI281929 CUi288 CIUWIU*@*UUWU</td>
                    </tr>
                </table>
            </div>
            <div class="modal-action">
                <button class="btn" onclick="modal_toggler('show-modal')">Close</button>
            </div>
        </div>
    </div>
</section>

@endsection