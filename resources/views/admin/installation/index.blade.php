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
                            Pasang Baru
                        </h3>
                    </div>
             
                </div>
                <div class="flex mt-2 w-full justify-center">
                    <form action="/admin/expenditure">
                        <div class="flex lg:space-x-2 flex-col lg:flex-row">
                            <div class="flex md:space-x-2 flex-col md:flex-row">
                                <input type="month" class="form-input " min="2021-01" value="{{ request('date') }}" name="date" id="">
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
                    <x-tables.thead thItem="#,pelanggan,alamat,expired,paket,teknisi,status,action" />
                    <tbody>
                        @foreach ($collection as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration }}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->user->name }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->user->alamat }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                @if ($item->expired)
                                {{ date('Y-m-d',strtotime($item->expired)) }}
                                @endif
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->package->name }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                @if ($item->technician_id!=null)
                                {{ $item->technician->name }}
                                @endif
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4 ">
                                <x-tables.status sts="{{ $item->status }}" />
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4 ">
                                <div class="flex space-x-2">
                                    @if ($item->status=="request")
                                    <button type="button" id="putData" onclick="toggleModal('accept')"
                                        data-id="{{ $item->id }}"> <i class="fas fa-check text-yellow-500"></i></button>
                                    @endif
                                    <button onclick="toggleModal('details')" type="button" data-pay="{{ $item }}"
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
<x-modals.regular title="Pilih Teknisi" id="accept">
    <form class="edit-form" method="post">
        @csrf
        @method("put")
        <div class="px-4 py-4">
            <input id="technician-name" type="text" required name="name" placeholder="Masukkan nohp/nama teknisi"
                class="w-full rounded-md">
            <select name="blok" class="block mt-2 w-full rounded-md">
                <option selected disabled hidden>PILIH SALAH SATU</option>
                @foreach ($blok as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <button class="bg-green-500 hover:bg-green-400 text-white rounded-sm px-4 py-1 mt-4">Proses</button>
        </div>
    </form>
</x-modals.regular>
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
        <form  id="delete-form" method="POST">
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
<script>
    $(document).ready(function() {
        setTimeout(function(){ $('#alert').hide('slow') }, 5000);
        $(document).on("click","#putData",function(){
            let id=$(this).data("id");
            $(".edit-form").attr('action','/admin/installation/'+id)
        })
        $(document).on("click","#btn-detail",function(){
           $(".table-detail #pelanggan").html($(this).data("pay")['user']['name'])
           $(".table-detail #alamat").html($(this).data("pay")['user']['alamat'])
           $(".table-detail #paket").html($(this).data("pay")['package']['name'])
           $(".table-detail #status").html($(this).data("pay")['status'])
           $(".table-detail #expired").html($(this).data("pay")['expired']==null?"-":
           $(this).data("pay")['expired'])
           $("#pause-form").attr("action","/admin/installation/"+$(this).data("pay")['id'])
           $(".table-detail #blok").html($(this).data("pay")['blok_id']==null?"-":
           $(this).data("pay")['bloks']['name']
           )
        $("#delete-form").attr("action","/admin/installation/"+$(this).data("pay")['id']);
           if($(this).data("pay")['status'].toLowerCase()=="paused"){
            $("#pause-form button").val("continue");
            $("#pause-form button").html("Continue");
            $("#delete-form button").html("Berhenti Selamanya");
            $("#pause-form button").attr("hidden",false);
           }else if($(this).data("pay")['status'].toLowerCase()=="installed"){
            $("#delete-form button").html("Berhenti Selamanya");
            $("#pause-form button").val("pause");
            $("#pause-form button").html("pause");
            $("#pause-form button").attr("hidden",false);
           }else{
            $("#delete-form button").html("Tolak");
            $("#pause-form button").attr("hidden",true);
           }
           $(".table-detail #penagih").html($(this).data("pay")['blok_id']==null?"-":
           $(this).data("pay")['bloks']['collectors']['name']
           )
           $(".table-detail #teknisi").html($(this).data("pay")['technician']==null?"-":$(this).data("pay")['technician']['name'])

           $(".table-detail #createdat").html($(this).data("pay")['created_at'].slice(0,10))

        })
        let nama=[];
        $.ajax({
        url:"/admin/installation/selectJquery",
        type:"get",
        data:{"_token": $('meta[name="csrf-token"]').attr('content'),"search":3},
        dataType:"json",
        success:function(data) {
           data.forEach(element => {
               nama.push(`${element.phone}-${element.name}`);
              })
           }})
         $(function(){ $("#technician-name").autocomplete({ source:nama })})
});
</script>
@endsection