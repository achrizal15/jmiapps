@extends('templates.admin')
@section('content')

<section class="px-4 md:px-10 mx-auto w-full -m-24">
    <div class="w-full mb-12 px-4 mt-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
            @if (session("success"))
            <div class="p-4">
                <x-alert type="success">
                    {{session('success')}}
                </x-alert>
            </div>
            @endif
            @if ($errors->any())
            <div class="p-4">
                <x-alert type="error">
                    Gagal! silahkan coba lagi.
                </x-alert>
            </div>
            @endif

            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="relative w-full px-2 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-lg text-gray-700">
                            Daftar Product
                        </h3>
                    </div> <button class="font-semibold rounded-sm px-3 py-0.5 shadow-lg bg-blue-600 text-sm text-white"
                        onclick="toggleModal('regular-modal-id')">ADD</button>
                </div>
            </div>
            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->
                <x-tables.table>
                    <x-tables.thead thItem="Nomor,Name,Qty,Harga,status" />
                    <tbody>
                       
                        @foreach ($collection as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration }}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                {{$item->name}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                {{$item->qty}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                Rp.{{ $item->harga }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 flex justify-between">
                                <x-tables.status sts="{{ $item->status }}" />
                                <div class="flex space-x-2">
                                    <form method="POST" action="/admin/barang/{{ $item->id }}/edit">
                                        @method('put')
                                        @csrf
                                        <x-buttons.edit />
                                    </form>
                                    <form method="POST" action="/admin/barang/{{ $item->id }}">
                                        @method('delete')
                                        @csrf
                                        <x-buttons.delete />
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </x-tables.table>
            </div>
        </div>
    </div>
    @include('templates.footer')
</section>
{{-- Modlas --}}
<x-Modals.Regular title="Tambah product">
    <form action="/admin/barang" method="post">
        @csrf
        <div class="space-x-0 p-4 bg-gray-300 mb-2 md:space-y-2 space-y-0">
            <input type="text" placeholder="Nama barang" name="name" value="{{ old('name') }}"
                class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <input type="number" placeholder="Qty" name="qty" value="{{ old('qty') }}"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                <input type="number" placeholder="Harga per item" name="harga" value="{{ old('harga') }}"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
            </div>

        </div>
        <div class="flex items-center justify-end mx-4 ">
            <button type="submit"
                class="bg-green-400 px-4 py-1 hover:bg-green-600 text-white rounded-sm">Simpan</button>
        </div>
    </form>
</x-Modals.Regular>
<script>
    
</script>
@endsection