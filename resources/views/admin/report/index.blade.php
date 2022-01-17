@extends('templates.admin')

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
                        <h3 class="font-semibold text-lg text-gray-700 inline uppercase">
                            Daftar {{ $title }}
                        </h3>
                    </div>
                    {{-- <button class="font-semibold rounded-sm px-3 py-0.5 shadow-lg bg-blue-600 text-sm text-white"
                        id="btn-add" onclick="toggleModal('add-data')">ADD</button> --}}
                </div>
                <div class="flex mt-2 w-full justify-center">
                    <form action="/admin/report">
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
                                <a href="/admin/report"
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
                    <x-tables.thead thItem="#,tanggal,Member,Constraint,Teknisi,Status,Detail,action" />
                    <tbody>
                        @foreach ($reports as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration+$reports->firstItem()-1}}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->created_at}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->member->name }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->constraint}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->technician==null?"Tidak menggunakan teknisi!": $item->technician->name}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ ucwords($item->status) }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->detail}}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4 flex justify-between">
                                <div class="flex space-x-2 ">
                                    {{-- <button class="btn btn-info"><i class="far fa-comment-dots"></i></button> --}}
                                    <button type="button" class="btn 
                                    @if ($item->status== 'pending') btn-success @else btn-disabled @endif btn-sm"
                                        data-items="{{ json_encode($item) }}" id="btn-edit"
                                        onclick="toggleModal('edit-data')"> <i class="fas fa-check"></i></button>
                                    <form method="POST" action="/admin/report/{{ $item->id }}">
                                        @method('delete')
                                        @csrf
                                        <button
                                        onclick="return confirm('Apakah anda yakin?')"
                                            class="btn btn-sm bg-red-500 border-transparent hover:border-transparent hover:bg-red-500 "><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-tables.table>
            </div>
            <div class="mx-4 my-4"> {{ $reports->links('components.pagination.default') }}</div>
        </div>
    </div>
    @include('templates.footer')
</section>
{{-- modal Add --}}
<x-modals.regular title="Ajukan Gaji Teknisi" id="add-data">
    <form action="/admin/salary" method="post">
        @csrf
        <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
            <div>
                <label class="font-semibold text-gray-500">Nama Lengkap</label>
                <select name="user_id" id="technician-select" style="width: 100%;padding:5px 5px;">
                    <option selected disabled hidden>Pilih Teknisi</option>
                </select>
            </div>
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Potongan Gaji<span
                            class="text-xs">(opsional)</span></label>
                    <input type="number" placeholder="500000" name="pay_cut" value="{{ old('pay_cut') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Gaji</label>
                    <input type="number" id="balance" placeholder="2500000000" name="balance"
                        value="{{ old('balance') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Bonus<span class="text-xs">(opsional)</span></label>
                    <input type="number" placeholder="500000" name="bonus" value="{{ old('bonus') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
            </div>
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Catatan<span class="text-xs">(opsional)</span></label>
                    <input type="text" placeholder="Jika ada" name="note" value="{{ old('note') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mx-4 ">
            <button type="submit"
                class="bg-green-400 px-4 py-1 hover:bg-green-600 text-white rounded-sm">Simpan</button>
        </div>
    </form>
</x-modals.regular>
<x-modals.regular title="Terima Report" id="edit-data">
    <form method="post" class="update-form">
        @csrf
        @method('put')
        <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
            <div>
                <label class="font-semibold text-gray-500">Teknisi<span class="text-xs">(jika dibutuhkan)</span>
                </label>
                <select name="technician_id" id="init-select2" data-type="technician" style="width:100%">
                </select>
            </div>

            <div class="md:flex-row flex md:space-x-2 flex-col">
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Pesan<span class="text-xs">(opsional)</span></label>
                    <input type="text" placeholder="Jika ada" name="message" value="{{ old('note') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-800 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end mx-4 ">
            <button type="submit" class="btn btn-wide btn-success">Proses Laporan</button>
        </div>
    </form>
</x-modals.regular>
<script>
    $(document).ready(function () {
     $(document).on("click","#btn-edit",function(){
         let data =$(this).data("items");
         $("form.update-form").attr("action","/admin/report/"+data['id'])
     })
    
    });
</script>
@endsection