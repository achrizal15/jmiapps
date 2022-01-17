@extends('templates.pemilik')
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
                            <h3 class="font-semibold text-lg text-gray-700 inline uppercase">
                                Pasang Baru
                            </h3>
                        </div>
                        <div class="space-x-2">
                            <a class="my-btn-sm bg-green-600" href="/pemilik/installation/export?date={{ request("date") }}"><i class="fas fa-file-excel"></i></a>
                        </div>
                    </div>
                    <div class="flex mt-2  w-full justify-center">
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
                                    <a href="/pemilik/installation"
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
                        <x-tables.thead thItem="#,pelanggan,alamat,port,expired,paket,teknisi,status,action" />
                        <tbody>
                            @foreach ($collection as $item)
                                <tr>
                                    <td
                                        class="text-center align-middle">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td
                                        class="border-t-0 align-middle px-6  border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->user->name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->user->alamat }}
                                    </td>
                                    <td class="text-center ">{{ $item->port ? $item->port : '-' }}</td>
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
                                        class="border-t-0 px-6 text-center align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4 ">
                                        <div class="flex space-x-2">
                                    
                                            <button data-item="{{ $item }}" id="btn-print"
                                                class="my-btn-sm bg-red-600"><i
                                                    class="fas fa-file-pdf"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-tables.table>
                </div>
                <div class="mx-4 my-4"> {{ $collection->links("components.pagination.default") }}</div>
            </div>

        </div>

        @include('templates.footer')
    </section>
    <div class="print:block hidden justify-center items-center pt-24" id="print-paper-installation">
        <div class="print:w-full w-1/2 rounded-md border-2 shadow-md p-4">
            <div class="grid grid-cols-6 pt-4 overflow-hidden">
                <div class="flex items-center col-span-2 justify-center h-52 border-r-2">
                    <img src="/img/mascot.jpeg" class="object-cover" width="100%" alt="">
                </div>
                <div class="flex items-center col-span-3 justify-center  mx-4">
                    <table class="w-full">
                        <tr>
                            <td class="font-bold w-8 align-top">USERNAME</td>
                            <td class="align-top w-8 text-center">:</td>
                            <td id="username_pdf" class="align-top">CI2132</td>
                        </tr>
                        <tr>
                            <td class="font-bold w-8 align-top">NAMA</td>
                            <td class="align-top w-8 text-center">:</td>
                            <td id="nama_pdf" class="align-top">ACH RIZAL</td>
                        </tr>
                        <tr>
                            <td class="font-bold w-8 align-top">TANGGAL</td>
                            <td class="align-top w-8 text-center">:</td>
                            <td id="date_pdf" class="align-top">2021-12-12</td>
                        </tr>
                        <tr>
                            <td class="font-bold w-8 align-top">TEKNISI</td>
                            <td class="align-top w-8 text-center">:</td>
                            <td id="teknisi_pdf" class="align-top">ALDO ANTARA</td>
                        </tr>
                    </table>
                </div>
                <div class="text-center flex items-center border-l-2">
                    <h4 class="rotate-90 font-bold antialiased ">BUKTI PEMASANGAN</h4>
                </div>
            </div>
        </div>
    </div>
<script>
   function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}
</script>

@endsection
