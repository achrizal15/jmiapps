@extends('templates.admin')
@section('content')
    <input type="text" hidden readonly value="admin-installation" id="page-name">
    <section class="px-4 md:px-10 mx-auto w-full -m-24">
        <div class="w-full mb-12 px-4 mt-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                @if (session('success'))
                    <div class="p-4" id="alert">
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    </div>
                @endif
                @if (session('error'))
                    <div class="p-4" id="alert">
                        <x-alert type="error">
                            {{ session('error') }}
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
                                Pasang Baru
                            </h3>
                        </div>
                    </div>
                    <div class="flex mt-2 w-full justify-center">
                        <form action="/admin/expenditure">
                            <div class="flex lg:space-x-2 flex-col lg:flex-row">
                                <div class="flex md:space-x-2 flex-col md:flex-row">
                                    <input type="month" class="form-input " min="2021-01" value="{{ request('date') }}"
                                        name="date" id="">
                                    <select name="status" id="" class="form-select rounded-sm">
                                        <option selected hidden value="">Filters</option>
                                        <option value="pending" @if (request('status') == 'pending') selected @endif>Pending
                                        </option>
                                        <option value="reject" @if (request('status') == 'reject') selected @endif>Reject
                                        </option>
                                        <option value="accept" @if (request('status') == 'accept') selected @endif>Accept
                                        </option>
                                    </select>
                                </div>
                                <div class="shadow flex">
                                    <input name="search"
                                        class="w-full rounded p-2 focus:outline-none border-none focus:ring-0" type="search"
                                        value="{{ request('search') }}" placeholder="Search...">
                                    <button type="submit"
                                        class="bg-white w-auto  flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                @if (count(request()->all()))
                                    <a href="/admin/expenditure"
                                        class="bg-red-500 text-center px-3 text-white flex items-center rounded-sm">Reset</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <!-- Projects table -->
                    <x-tables.table>
                        <x-tables.thead thItem="#,pelanggan,alamat,expired,paket,teknisi,status,action" />
                        <tbody>
                            @foreach ($collection as $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->user->name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->user->alamat }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        @if ($item->expired)
                                            {{ date('Y-m-d', strtotime($item->expired)) }}
                                        @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->package->name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        @if ($item->technician_id != null)
                                            {{ $item->technician->name }}
                                        @endif
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4 ">
                                        <x-tables.status sts="{{ $item->status }}" />
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4 ">
                                        <div class="flex space-x-2">
                                            @if ($item->status == 'request')
                                                <button type="button" id="btn-accept"
                                                    onclick="modal_toggler('accept-modal')"
                                                    data-id="{{ $item->id }}"> <i
                                                        class="fas fa-check text-yellow-500"></i></button>
                                            @endif
                                            <button onclick="toggleModal('details')" type="button"
                                                data-pay="{{ $item }}"
                                                id="btn-detail">
                                                <i class="fas fa-info-circle text-blue-500"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-tables.table>
                </div>
                <div class="mx-4 my-4"> {{ $collection->links() }}</div>
            </div>

        </div>
        @include('templates.footer')
    </section>
    {{-- modal --}}
    <div class="modal" id="accept-modal">
        <div class="modal-box">
            <div class="modal-header">
                <h2 class="font-bold">LANJUTKAN INSTALLASI</h2>
            </div>
            <form id="form-accept" method="post">
                @csrf
                @method("put")
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Teknisi</span>
                    </label>
                    <select name="teknisi" class="form-select2-basic"
                        data-dropdownParent=".modal">
                        <option></option>
                        @foreach ($teknisi as $t)
                            <option @if (old('teknisi') == $t->id)
                                selected
                                @endif value="{{ $t->id }}">{{ $t->name . ':' . $t->phone }}</option>
                        @endforeach
                    </select>
                    <label id="teknisi-error" class="error text-sm text-red-500 hidden" for="teknisi"></label>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Blok Area</span>
                    </label>
                    <select name="blok" class="form-select2-basic" data-dropdownParent=".modal" data-search-hidden="true">
                        <option></option>
                        @foreach ($blok as $b)
                            <option @if (old('blok') == $b->id)
                                selected
                                @endif value="{{ $b->id }}">{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Biaya Tambahan</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">
                                Rp
                            </span>
                        </div>
                        <input type="number" name="price" id="price"
                            min="0"
                            value="0"
                            class="my-input form-input block w-full pl-10"
                            placeholder="0">
                    </div>
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Diskon <small>(Opsional)</small></span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">
                                Rp
                            </span>
                        </div>
                        <input type="number" name="diskon"
                            min="0"
                            value="0"
                            class="my-input form-input block w-full pl-10"
                            placeholder="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SUBMIT</button>
                    <button type="submit" class="btn btn-error">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
    {{-- INFORMATION --}}
    <x-modals.regular title="Detail Pemasangan" id="details">
        <div class="px-4 py-4">
            <div class="grid md:grid-cols-2 grid-cols-1 md:gap-4 table-detail">
                <div>
                    <table>
                        <tr>
                            <td class="w-24">
                                Pelanggan
                            </td>
                            <td class="w-4"> : </td>
                            <td id="pelanggan">
                                Nuri
                            </td>
                        </tr>
                        <tr>
                            <td class="w-24">
                                Alamat
                            </td>
                            <td> : </td>
                            <td id="alamat">
                                Kemiren
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Paket
                            </td>
                            <td> : </td>
                            <td id="paket">
                                Lolosa
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Teknisi
                            </td>
                            <td> : </td>
                            <td id="teknisi">
                                Ajeng
                            </td>
                        </tr>

                    </table>
                </div>
                <div>
                    <table>
                        <tr class="w-24">
                            <td>
                                Penagih
                            </td>
                            <td> : </td>
                            <td id="penagih">
                                Ajeng
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Blok
                            </td>
                            <td> : </td>
                            <td id="blok">
                                Blok Z
                            </td>
                        </tr>
                        <tr>
                            <td class="w-24">
                                Created At
                            </td>
                            <td class="w-4"> : </td>
                            <td id="createdat">
                                2021-10-10
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Expired
                            </td>
                            <td> : </td>
                            <td id="expired">
                                -
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Status
                            </td>
                            <td> : </td>
                            <td id="status">
                                test
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <form id="delete-form" method="POST">
                @method("delete")
                @csrf
                <button type="submit" onclick="return confirm('Peringatan!, semua data pemasangan akan terhapus permanen!')"
                    class="bg-red-500 hover:bg-red-400 text-white rounded-sm px-4 py-1 mt-4">Berhenti Selamanya</button>
            </form>
            <form action="/admin/installation" id="pause-form" method="post">
                @csrf
                <button type="submit" name="type"
                    class="bg-yellow-500 hover:bg-yellow-400 text-white rounded-sm px-4 py-1 mt-4">Pause</button>
            </form>
        </div>
    </x-modals.regular>

@endsection
