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
                            Daftar Pengajuan Pembelanjaan
                            <div class="has-tooltip inline-block">
                                <span
                                    class="tooltip rounded-sm shadow-lg p-0.5 bg-gray-100 text-red-500 -mt-8 text-xs">Hanya
                                    pengajuan dengan status pending yang dapat dirubah!</span>
                                <i class="fas fa-exclamation text-xs text-blue-600 ml-2"></i>
                            </div>
                        </h3>
                    </div>
                    <a class="font-semibold rounded-sm px-3 py-0.5 shadow-lg bg-blue-600 text-sm text-white"
                        href="/admin/installation/create">ADD</a>
                </div>
                <div class="flex mt-2 w-full justify-center">
                    <form action="/admin/expenditure">
                        <div class="flex lg:space-x-2 flex-col lg:flex-row">
                            <div class="flex md:space-x-2 flex-col md:flex-row">
                                <input type="month" min="2021-01" value="{{ request('date') }}" name="date" id="">
                                <select name="status" id="" class="form-select rounded-sm">
                                    <option selected hidden value="">Filters</option>
                                    <option value="pending" @if(request('status')=='pending' ) selected @endif>Pending
                                    </option>
                                    <option value="reject" @if(request('status')=='reject' ) selected @endif>Reject
                                    </option>
                                    <option value="accept" @if(request('status')=='accept' ) selected @endif>Accept
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
                            @if(count(request()->all()))
                            <a href="/admin/expenditure"
                                class="bg-red-500 text-center px-3 text-white flex items-center rounded-sm">Reset</a>@endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->
                <x-tables.table>
                    <x-tables.thead thItem="#,Nama barang,Stock,Type pembelian,Suplier,Harga,Anggaran,status" />
                    <tbody>
                        @foreach ($collection as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration }}
                            </th>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{$item->name_product}}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{$item->stock}}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{ $item->type }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{ $item->name_suplier}}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                @rupiah($item->price)
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                @rupiah($item->balance)
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4 flex justify-between">
                                <x-tables.status sts="{{ $item->status }}" />
                                <div class="flex space-x-2">
                                    @if ($item->status=='pending')
                                    <form method="POST" action="/admin/expenditure/{{ $item->id }}/edit">
                                        @csrf
                                        <button type="button" id="putData" onclick="toggleModal('edit-data')"
                                            data-id="{{ $item->id }}"> <i
                                                class="fas fa-edit text-yellow-500"></i></button>
                                    </form>
                                    @endif
                                    <form method="POST" action="/admin/expenditure/{{ $item->id }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Pilih ok untuk melanjutkan.')"> <i
                                            class="fas fa-trash text-red-500"></i></button>
                                    </form>
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

<script>
    $(document).ready(function() {
        setTimeout(function(){ $('#alert').hide('slow') }, 5000);
        $(document).on('click', '#putData', function () {
        let id=$(this).data("id");
        let radios=$('input:radio[name=type]');
    $.ajax({
        url:"/admin/expenditure/"+id+"/edit",
         type:"get",
        data:{"_token": $('meta[name="csrf-token"]').attr('content'),
        "id": id},
        dataType:"json",
        success:function(data){
             $(".form-edit").attr('action',"/admin/expenditure/"+data['id']);
            $("#idx").val(data['id']);
            $("#productname").val(data['name_product']);
            $("#supliername").val(data['name_suplier']);
            $("#pengeluaran").val(data['balance']);
            $("#stock").val(data['stock']);
            $("#price").val(data['price']);
            $("#notes").html(data['notes']);
            if(data['type']=="Online"){
               radios.filter('[value=Online]').prop("checked", true);
            }else{
                radios.filter('[value=Offline]').prop("checked", true);
            }
        }
     })
    });
});
</script>
@endsection
