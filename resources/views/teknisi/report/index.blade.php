@extends('templates.teknisi')
@section('content')
    <section class="px-4 md:px-10 mx-auto w-full -m-24">
        <div class="w-full mb-12 px-4 mt-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                @if (session('success'))
                    <div
                        class="p-4"
                        id="alert">
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="p-4"
                        id="alert">
                        <x-alert type="error">
                            {{ session('error') }}
                        </x-alert>
                    </div>
                @endif
                @if ($errors->any())
                    <div
                        class="p-4"
                        id="alert">
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
                    <table
                        class="table table-datatable"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Alamat</th>
                                <th>Phone</th>
                                <th>Kerusakan</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $r)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}</td>
                                    <td>
                                        {{ $r->created_at }}
                                    </td>
                                    <td>
                                        {{ $r->member->name }}
                                        {{-- <a
                                            href="#"
                                            class="text-blue-500"> (VIEW) </a> --}}
                                    </td>
                                    <td>
                                        {{ $r->member->alamat }}
                                    </td>
                                    <td>
                                        {{ $r->member->phone }}
                                    </td>
                                    <td>
                                        {{ $r->detail }}
                                    </td>
                                    <td class="text-center">
                                        @if ($r->status == 'process')
                                            <button
                                                onclick="modal_toggler('show-modal')"
                                                data-user="{{ $r->member }}"
                                                id="btn-show"
                                                class="my-btn-sm bg-blue-500 hover:bg-blue-600">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a
                                                href="/teknisi/report/{{ $r->id }}"
                                                id="btn-teknisi-report-repair"
                                                class="my-btn-sm bg-green-500 inline-block hover:bg-green-600">
                                                <i class="fas fa-wrench"></i>
                                            </a>
                                        @else
                                            <span class="italic text-gray-400">Fixed</span>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('templates.footer')
        <div
            id="tagihan-modal"
            class="modal">
            <div class="modal-box">
                <div class="mb-4 ">
                    {{-- heading --}}
                    <h3><b>PERPANJANG LANGGANAN </b> </h3>
                </div>
                <form
                    action="/teknisi/penagihan"
                    method="post"
                    id="form-tagihan"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- HIDDEN --}}
                    <input
                        type="text"
                        hidden
                        name="installation_id"
                        readonly>
                    <input
                        type="text"
                        hidden
                        name="member_id"
                        readonly>
                    <div class="grid md:grid-cols-2 md:gap-4">
                        <div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nama Pelanggan</span>
                                </label>
                                <input
                                    type="text"
                                    readonly
                                    id="member-name"
                                    class="input input-bordered">
                                <label
                                    id="redaman-error"
                                    class="error text-xs text-red-500 hidden"
                                    for="redaman"></label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Paket</span>
                                </label>
                                <input
                                    type="text"
                                    id="paket-name"
                                    readonly
                                    value="Premium"
                                    class="input input-bordered">
                                <label
                                    id="redaman-error"
                                    class="error text-xs text-red-500 hidden"
                                    for="redaman"></label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Harga Paket</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input
                                        type="text"
                                        id="paket-price"
                                        readonly
                                        value="50000"
                                        class="input input-bordered w-full rounded-md">
                                </label>
                                <label
                                    id="installation_costs-error"
                                    class="error text-xs text-red-500 hidden"
                                    for="installation_costs"></label>
                            </div>
                        </div>
                        <div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Tagihan</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input
                                        id="tagihan"
                                        type="text"
                                        readonly
                                        value="50000"
                                        class="input input-bordered w-full rounded-md">
                                </label>
                                <label
                                    id="installation_costs-error"
                                    class="error text-xs text-red-500 hidden"
                                    for="installation_costs"></label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Upload Bukti</span>
                                </label>
                                <input
                                    type="file"
                                    name="transfer_img"
                                    required
                                    class="input pt-1.5 input-bordered">
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Detail
                                        <small>(optional)</small></span>
                                </label>
                                <textarea
                                    name="message"
                                    name="message"
                                    class="textarea h-24 textarea-bordered"
                                    placeholder="Jika ada"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-action">
                        <button
                            type="submit"
                            class="btn btn-success">Submit</button>
                        <a
                            href="/teknisi/penagihan#close"
                            class="btn btn-error">Close</a>
                    </div>
                </form>
            </div>
        </div>
        <div
            id="show-modal"
            class="modal">
            <div class="modal-box">
                <div class="mb-4 ">
                    {{-- heading --}}
                    <h3><b>DETAIL PELANGGAN </b> </h3>
                </div>
                <img
                    src="https://picsum.photos/id/1005/100/100"
                    class="mask mask-hexagon">
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
                        <tr>
                            <td class="w-12">Alamat</td>
                            <td>:</td>
                            <td id="address">Jakarta</td>
                        </tr>
                        <tr>
                            <td>Maps</td>
                            <td>:</td>
                            <td id="maps">CUI281929 CUi288 CIUWIU*@*UUWU</td>
                        </tr>
                    </table>

                </div>
                <div class="modal-action">
                    <button
                        class="btn"
                        onclick="modal_toggler('show-modal')">Close</button>
                </div>
            </div>
        </div>
    </section>

@endsection
