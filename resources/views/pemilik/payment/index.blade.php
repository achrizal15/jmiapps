@extends('templates.pemilik')
@section('content')
    <input type="hidden" readonly id="page-name" value="payment">
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
                            <h3 class="font-semibold text-lg text-gray-700 inline uppercase">
                                Pembayaran Bulanan
                            </h3>
                        </div>
                        <div class="space-x-2">
                            <a class="my-btn-sm bg-green-600" href="/pemilik/pembayaran/export?date={{ request("date") }}"><i class="fas fa-file-excel"></i></a>
                        </div>
                    </div>
                    <div class="flex mt-2 w-full justify-center">
                        <form action="">
                            <div class="flex lg:space-x-2 lg:space-y-0 space-y-4  flex-col lg:flex-row">
                                <div class="flex md:space-x-2 flex-col md:flex-row">
                                    <input type="month" class="form-input my-input" min="2015-01"
                                        value="{{ request('date') }}"
                                        name="date" id="">
                                </div>
                                <input name="search"
                                    class="my-input form-input" type="search"
                                    value="{{ request('search') }}" placeholder="Search...">

                                <button type="submit"
                                    class="btn bg-blue-800 btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if (count(request()->all()))
                                    <a href="/pemilik/payment"
                                        class="btn bg-red-500 btn-error"><i class="fa fa-refresh"
                                            aria-hidden="true"></i></a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <!-- Projects table -->
                    <x-tables.table>
                        <x-tables.thead thItem="#,tanggal,Nama,paket,tagihan,status" />
                        <tbody>
                            @foreach ($payments as $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                        {{ $loop->iteration + $payments->firstItem() - 1 }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->created_at }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->member->name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->installations->package->name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        @rupiah($item->installations->package->price)
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        <x-tables.status sts="{{ $item->status }}" />
                                    </td>
                              
                                </tr>
                            @endforeach
                        </tbody>
                    </x-tables.table>
                </div>
                <div class="mx-4 my-4"> {{ $payments->links('components.pagination.default') }}</div>
            </div>
        </div>
        @include('templates.footer')
    </section>
@endsection
