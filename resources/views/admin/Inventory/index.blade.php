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
                        onclick="toggleModal('add-product')">ADD</button>
                </div>
                <div class="flex mt-2 w-full justify-center">
                    <form action="/admin/product">
                        <div class="flex lg:space-x-2 flex-col lg:flex-row">
                            <div class="flex md:space-x-2 flex-col md:flex-row">
                                <input type="month" min="2021-01" value="{{ request('date') }}" name="date" id="">
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
                            <a href="/admin/product"
                                class="bg-red-500 text-center px-3 text-white flex items-center rounded-sm">Reset</a>@endif
                        </div>
                    </form>
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
                                {{$item->stock}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                @rupiah($item->price)
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 flex justify-between">
                                <x-tables.status sts="{{ $item->status }}" />
                                <div class="flex space-x-2">
                                 
                                        <button type="button" id="edit-data" data-id="{{ $item->id }}"
                                            onclick="toggleModal('edit-product')">
                                            <i class="fas fa-edit text-yellow-500"></i>
                                        </button>
                               
                                    <form method="POST" action="/admin/product/{{ $item }}">
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
<x-Modals.Regular title="Tambah product" id="add-product">
    <form action="/admin/product" method="post">
        @csrf
        <div class="space-x-0 p-4 bg-gray-300 mb-2 md:space-y-2 space-y-0">
            <input type="text" placeholder="Nama barang" name="name" value="{{ old('name') }}"
                class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <input type="number" placeholder="Stock" name="stock" value="{{ old('stock') }}"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                <input type="number" placeholder="Harga per item" name="price" value="{{ old('price') }}"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
            </div>
            <div class="flex items-center space-x-2">
                <input value="ready" type="radio" name="status" id="ready" class=" focus:bg-green-500" checked>
                <label for="ready">Ready</label>
            </div>
            <div class="flex items-center space-x-2">
                <input value="broken" type="radio" name="status" id="broken" class="active:bg-red-500 focus:bg-red-500">
                <label for="broken">Broken</label>
            </div>
        </div>
        <div class="flex items-center justify-end mx-4 ">
            <button type="submit"
                class="bg-green-400 px-4 py-1 hover:bg-green-600 text-white rounded-sm">Simpan</button>
        </div>
    </form>
</x-Modals.Regular>
{{-- Edit --}}
<x-Modals.Regular title="Edit Product" id="edit-product">
    <form class="edit-form" method="POST">
        @method("put")
        @csrf
        <div class="space-x-0 p-4 bg-gray-300 mb-2 md:space-y-2 space-y-0">
            <input type="text" placeholder="Nama barang" name="name" id="product-name"
                class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <input type="number" placeholder="Stock" name="stock" id="stock"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                <input type="number" placeholder="Harga per item" name="price" id="price"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
            </div>
            <div class="flex items-center space-x-2">
                <input value="ready" type="radio" name="status" class=" focus:bg-green-500">
                <label for="ready">Ready</label>
            </div>
            <div class="flex items-center space-x-2">
                <input value="broken" type="radio" name="status" class="active:bg-red-500 focus:bg-red-500">
                <label for="broken">Broken</label>
            </div>
        </div>
        <div class="flex items-center justify-end mx-4 ">
            <button type="submit"
                class="bg-green-400 px-4 py-1 hover:bg-green-600 text-white rounded-sm">Simpan</button>
        </div>
    </form>
</x-Modals.Regular>
<script>
    $(document).ready(function(){
    $(document).on('click','#edit-data',function(){
        let id=$(this).data('id');
        let token= $('meta[name="csrf-token"]').attr('content');
        let radios=$('input:radio[name=status]');  
        $.ajax({
                url:'/admin/product/'+id+'/edit',
                type:'get',
                data:{'id':id},     
                dataType:"json",
                success:function(data){
                    console.log(data)
                    $(".edit-form").attr('action','/admin/product/'+data['id'])
                    $("#product-name").val(data['name'])
                    $("#stock").val(data['stock'])
                    $("#price").val(data['price'])
                    if(data['status']=="ready"){
                        radios.filter('[value=ready]').prop('checked',true)
                    }else{
                        radios.filter('[value=broken]').prop('checked',true)
                    }
                }
            })
    })
})
</script>
@endsection