@extends('templates.pemilik')
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
                       DAFTAR GAJI TEKNISI
                        </h3>
                    </div>
                    <div class="space-x-2">
                        <a class="my-btn-sm bg-green-600" href="/pemilik/salary/export?date={{ request("date") }}"><i class="fas fa-file-excel"></i></a>
                    </div>
                </div>
                <div class="flex mt-2 w-full justify-center">
                    <form action="/pemilik/salary">
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
                                <a href="/pemilik/salary"
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
                    <x-tables.thead thItem="#,tanggal,Nama,bonus,potongan,Gaji,action" />
                    <tbody>
                        @foreach ($salaries as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration+$salaries->firstItem()-1}}
                            </th>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->created_at}}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->user->name}}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                            Rp.@rupiah($item->bonus)
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                               Rp.@rupiah($item->pay_cut)
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                @rupiah($item->balance)
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                @if ($item->status=="accept")
                                <span class="text-gray-300 text-center">{{ $item->status }}</span>
                                @else
                                <form class="flex space-x-2"
                                action="/pemilik/salary/{{ $item->id }}" method="post">
                                @method('put')
                                @csrf
                                <button name="status" value="accept" type="submit"
                                    onclick="return confirm('Apakah anda yakin?')" class="my-btn-sm bg-yellow-500"><i class="fas fa-check"></i></button>
                                <button name="status" value="reject" type="submit"
                                    onclick="return confirm('Apakah anda yakin menolak?')" class="my-btn-sm bg-red-500"> <i
                                        class="fas fa-window-close"></i></button>
                            </form>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-tables.table>
            </div>
            <div class="mx-4 my-4"> {{ $salaries->links('components.pagination.default') }}</div>
        </div>
    </div>
    @include('templates.footer')
</section>

@endsection
