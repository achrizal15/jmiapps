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
                            Pasang Baru
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
                    <x-tables.thead thItem="#,pelanggan,alamat,phone,paket,teknisi,status" />
                    <tbody>
                        @foreach ($collection as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration }}
                            </th>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{ $item->user->name }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{ $item->user->alamat }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{ $item->user->phone }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                {{ $item->package->name }}
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4">
                                @if ($item->technician_id!=null)
                                {{ $item->technician->name }}
                                @endif
                            </td>

                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4 flex justify-between">
                                <x-tables.status sts="{{ $item->status }}" />
                                <div class="flex space-x-2">
                                    @if ($item->status=="request")
                                    <button type="button" id="putData" onclick="toggleModal('accept')"
                                        data-id="{{ $item->id }}"> <i class="fas fa-edit text-yellow-500"></i></button>
                                    @endif

                                    <form method="POST" action="/admin/expenditure/{{ $item->id }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Pilih ok untuk melanjutkan.')">
                                            <i class="fas fa-trash text-red-500"></i></button>
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
{{-- modal --}}
<x-modals.regular title="Pilih Teknisi" id="accept">
    <form class="edit-form" method="post">
        @csrf
        @method("put")
        <div class="px-4 py-4">
            <input id="technician-name" type="text" required name="name" placeholder="Masukkan nohp/nama teknisi"
                class="w-full rounded-md">
            <button class="bg-green-500 hover:bg-green-400 text-white rounded-sm px-4 py-1 mt-4">Proses</button>
        </div>
    </form>
</x-modals.regular>
<script>
    $(document).ready(function() {
        setTimeout(function(){ $('#alert').hide('slow') }, 5000);
        $(document).on("click","#putData",function(){
            let id=$(this).data("id");
            $(".edit-form").attr('action','/admin/installation/'+id)
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
