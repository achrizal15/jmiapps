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
                        <h3 class="font-semibold text-lg text-gray-700 inline">
                            Daftar Blok
                        </h3>
                    </div>
                    <button class="font-semibold rounded-sm px-3 py-0.5 shadow-lg bg-blue-600 text-sm text-white"
                        id="btn-add" onclick="toggleModal('add-data')">ADD</button>
                </div>
                <div class="flex mt-2 w-full justify-start">
                    <form action="/admin/blok">
                        <div class="flex lg:space-x-2 flex-col lg:flex-row">

                            <div class="shadow flex">
                                <input name="search"
                                    class="w-full rounded p-2 focus:outline-none border-none focus:ring-0" type="search"
                                    value="{{ request('search') }}" placeholder="Search...">
                                <button type="submit"
                                    class="bg-white w-auto  flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            @if(isset($_GET['search'])||isset($_GET['date']))
                            <a href="/admin/blok"
                                class="bg-red-500 text-center px-3 text-white flex items-center rounded-sm">Reset</a>@endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->
                <x-tables.table>
                    <x-tables.thead thItem="#,blok,penagih,detail Alamat,action" />
                    <tbody>
                        @foreach ($bloks as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration+$bloks->firstItem()-1}}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->name}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->collectors->name}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->detail_address }}
                            </td>

                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4 flex justify-between">
                                <div class="flex space-x-2 ">
                                    <button type="button" data-id="{{ $item->id }}" id="btn-edit"
                                        onclick="toggleModal('edit-data')"> <i
                                            class="fas fa-edit text-yellow-500"></i></button>
                                    <form method="POST" action="/admin/blok/{{ $item->id }}">
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
            <div class="mx-4 my-4"> {{ $bloks->links('components.pagination.default') }}</div>
        </div>
    </div>
    @include('templates.footer')
</section>
{{-- modal Add --}}
<x-modals.regular title="Tambah Blok" id="add-data">
    <form action="/admin/blok" method="post">
        @csrf
        <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
            <div>
                <label class="font-semibold text-gray-500">Penagih</label>
                <select name="collector_id" id="technician-select" style="width: 100%" required>
                    <option selected disabled hidden>Pilih Karyawan</option>
                </select>
            </div>
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Nama Blok<span class="text-xs">(unique)</span></label>
                    <input type="text" required placeholder="Blok X" name="name" value="{{ old('name') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>

                <div class="w-full">
                    <label class="font-semibold text-gray-500">Detail alamat</label>
                    <input required type="text" placeholder="Rt/02 RW/01 Desa/Kota" name="detail_address" value="{{ old('note') }}"
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
<x-modals.regular title="Edit Blok" id="edit-data">
    <form action="" method="post" class="update-form">
        @csrf
        @method('put')
        <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
            <div>
                <label class="font-semibold text-gray-500">Penagih</label>
                <select name="collector_id" id="technician-select-edit" style="width: 100%;padding:5px 5px;">
                </select>
            </div>
            <div class="md:flex-row flex md:space-x-2 flex-col">
                <div class="w-full">
                    <label class="font-semibold text-gray-500">Nama Blok<span class="text-xs">(unique)</span></label>
                    <input type="text" required id="blok-name" placeholder="Blok X" name="name" value="{{ old('name') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>

                <div class="w-full">
                    <label class="font-semibold text-gray-500">Detail alamat</label>
                    <input required type="text" id="detai-alamat" placeholder="Rt/02 RW/01 Desa/Kota" name="detail_address" value="{{ old('note') }}"
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
<script>
    $(document).ready(function () {
        setTimeout(function(){ $('#alert').hide('slow') }, 5000);
      
        $.ajax({
            type: "get",
            url: "/admin/installation/selectJquery",
            data:{"search":3},
            dataType: "json",
            success: function (response) {
             let data= response.map(function(e){
                  return {"id":e['id'],"text":e['name']+'-'+e['phone']}
             });
             $("#technician-select").select2({
                 data: data,
             })
             $(document).on("click","#btn-edit", function () {
               let id=$(this).data('id');
                 let token= $('meta[name="csrf-token"]').attr('content');
              $.ajax({
                type: "get",
                url: "/admin/blok/"+id+"/edit",
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    $("#technician-select-edit").select2({data: data})
                    $(".update-form").attr('action','/admin/blok/'+id)
                    let option=`<option selected hidden value="${response['collector_id']}" hidden>${response['collectors']['name']}
                                 </option>`;
                    data.forEach(e => {
                        if(e['id']!=response['collectors']['id']){
                            option+=`<option value="${e['id']}" hidden>${e['text']}</option>`
                        }
                    });
                    $("#technician-select-edit").html(option);  
                    $("#blok-name").val(response['name'])      
                    $("#detai-alamat").val(response['detail_address'])      
                }
            });
        });
            }
        });
    });
</script>
@endsection