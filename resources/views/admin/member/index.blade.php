@extends('templates.admin')
@section('content')

    <section class="px-4 md:px-10 mx-auto w-full -m-24">
        <div class="w-full mb-12 px-4 mt-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
                @if (session('success'))
                    <div class="p-4">
                        <x-alert type="success">
                            {{ session('success') }}
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
                                DAFTAR PELANGGAN
                            </h3>
                        </div> <button class="bg-blue-600 my-btn-sm"
                            onclick="toggleModal('add-product')"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="flex mt-2 w-full justify-center">
                        <form action="">
                            <div class="flex lg:space-x-2 lg:space-y-0 space-y-4  flex-col lg:flex-row">

                                <input name="search"
                                    class="my-input form-input" type="search"
                                    value="{{ request('search') }}" placeholder="Search...">

                                <button type="submit"
                                    class="btn bg-blue-800 btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if (count(request()->all()))
                                    <a href="/admin/member"
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
                        <x-tables.thead thItem="Nomor,name,phone,alamat,map,action" />
                        <tbody>
                            @foreach ($member as $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left font-bold text-gray-600 w-16">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                        <div class="w-20">{{ $item->name }}</div>
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                        {{ $item->phone }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                                   
                                            {{ $item->alamat }}
                                     
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4">
                        
                                            {{ $item->location }}
                             
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm w-20">
                                        <div class="flex space-x-2">
                                            <button type="button" id="edit-data" data-id="{{ $item->id }}"
                                                onclick="toggleModal('edit-product')">
                                                <i class="fas fa-edit text-yellow-500"></i>
                                            </button>

                                            <form method="POST" action="/admin/member/{{ $item->id }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit">
                                                    <i class="fas fa-trash text-red-500"></i>
                                                </button>
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
    <x-Modals.Regular title="Tambah Pelanggan" id="add-product">
        <form action="/admin/member" method="post">
            @csrf
            <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
                <input type="text" placeholder="Nama lengkap" name="name" value="{{ old('name') }}"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <input type="number" placeholder="Phone number" name="phone" value="{{ old('phone') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    <input type="email" placeholder="email" name="email" value="{{ old('email') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <input type="text" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    <input type="text" placeholder="Map location" name="location" value="{{ old('location') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <input type="password" placeholder="Password" name="password"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    <input type="password" placeholder="Re-password" name="re-password"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
            </div>
            <div class="flex items-center justify-end mx-4 ">
                <button type="submit"
                    class="bg-green-400 px-4 py-1 hover:bg-green-600 text-white rounded-sm">Simpan</button>
            </div>
        </form>
    </x-Modals.Regular>
    {{-- Edit --}}
    <x-Modals.Regular title="Edit Pelanggan" id="edit-product">
        <form action="/admin/member" method="post" class="edit-form">
            @csrf
            @method('put')
            <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
                <input type="text" placeholder="Nama lengkap" name="name" id="name"
                    class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <input type="number" placeholder="Phone number" name="phone" id="phone"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    <input type="email" placeholder="email" name="email" id="email"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <input type="text" placeholder="Alamat" name="alamat" id="alamat"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    <input type="text" placeholder="Map location" name="location" id="location"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <label id="show-pwd" class="px-4 py-1 bg-red-500 text-white">RESET PASSWORD</label>
                    <input type="text" placeholder="Password baru" name="password" id="password"
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
        $(document).ready(function() {
            $("#password").hide();
            $(document).on('click', "#show-pwd", function() {
                $("#password").toggle('slow');
            })
            $(document).on('click', '#edit-data', function() {
                let id = $(this).data('id');
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/admin/member/' + id + '/edit',
                    type: 'get',
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log
                        $(".edit-form").attr('action', '/admin/member/' + data['id'])
                        $("#name").val(data['name'])
                        $("#phone").val(data['phone'])
                        $("#email").val(data['email'])
                        $("#alamat").val(data['alamat'])
                        $("#location").val(data['location'])
                        $("#password").val(data['password'])
                    }
                })
            })
        })
    </script>
@endsection
