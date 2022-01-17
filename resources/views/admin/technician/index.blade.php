@extends('templates.admin')
@section('content')

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
                            <h3 class="font-semibold text-lg text-gray-700 inline">
                               DAFTAR TEKNISI
                            </h3>
                        </div>
                        <div class="space-x-2"> <a href="/admin/technician/export?role=3" class="my-btn-sm bg-green-600"><i
                                    class="fas fa-file-excel"></i></a>
                            <button class="bg-blue-600 my-btn-sm"
                                onclick="toggleModal('add-data')"><i class="fas fa-plus"></i></button>
                        </div>

                    </div>
                    <div class="flex mt-2 w-full justify-center">
                        <form action="/admin/technician">
                            <div class="flex lg:space-x-2 lg:space-y-0 space-y-4  flex-col lg:flex-row">
                                {{-- <div class="flex md:space-x-2 flex-col md:flex-row">
                                    <input type="month" class="form-input my-input" min="2015-01"
                                        value="{{ request('date') }}"
                                        name="date" id="">
                                </div> --}}
                                <input name="search"
                                    class="my-input form-input" type="search"
                                    value="{{ request('search') }}" placeholder="Search...">

                                <button type="submit"
                                    class="btn bg-blue-800 btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if (count(request()->all()))
                                    <a href="/admin/technician"
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
                        <x-tables.thead thItem="#,Nama,phone,alamat,action" />
                        <tbody>
                            @foreach ($technician as $item)
                                <tr>
                                    <th
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                        {{ $loop->iteration + $technician->firstItem() - 1 }}
                                    </th>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->name }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->phone }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                        {{ $item->alamat }}
                                    </td>
                                    <td
                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4 flex justify-between">
                                        <div class="flex space-x-2">
                                            <button type="button" data-id="{{ $item->id }}" id="btn-edit"
                                                onclick="toggleModal('edit-data')"> <i
                                                    class="fas fa-edit text-yellow-500"></i></button>
                                            <form method="POST" action="/admin/technician/{{ $item->id }}">
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
                <div class="mx-4 my-4"> {{ $technician->links('components.pagination.default') }}</div>
            </div>
        </div>
        @include('templates.footer')
    </section>
    {{-- modal Add --}}
    <x-modals.regular title="Teknisi Baru" id="add-data">
        <form action="/admin/technician" method="post">
            @csrf
            <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
                <div>
                    <label class="font-semibold text-gray-500">Nama Lengkap</label>
                    <input type="text" placeholder="Junaedy Susilo" name="name" value="{{ old('name') }}"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Email<span
                                class="text-xs">(opsional)</span></label>
                        <input type="email" placeholder="email" name="email" value="{{ old('email') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                    <div>
                        <label class="font-semibold text-gray-500">Nomor Handphone</label>
                        <input type="number" placeholder="0821782xxx" name="phone" value="{{ old('phone') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Alamat</label>
                        <input type="text" placeholder="Jln.Kemiren glagah" name="alamat" value="{{ old('alamat') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Map Location<span
                                class="text-xs">(opsional)</span></label>
                        <input type="text" placeholder="Link google map" name="location" value="{{ old('location') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Password</label>
                        <input type="password" placeholder="*2wj2*&" name="password"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Ulangi Password</label>
                        <input type="password" placeholder="*2wj2*&" name="password_confirmation"
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
    <x-modals.regular title="Edit Teknisi" id="edit-data">
        <form action="/admin/technician" method="post" id="update-form">
            @csrf
            @method('put')
            <div class="space-x-0 p-4 bg-gray-100 mb-2 md:space-y-2 space-y-0">
                <div>
                    <label class="font-semibold text-gray-500">Nama Lengkap</label>
                    <input type="text" placeholder="Junaedy Susilo" name="name" value="asss"
                        class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Email<span
                                class="text-xs">(opsional)</span></label>
                        <input type="email" placeholder="email" name="email" value="{{ old('email') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                    <div>
                        <label class="font-semibold text-gray-500">Nomor Handphone</label>
                        <input type="number" placeholder="0821782xxx" name="phone" value="{{ old('phone') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col">
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Alamat</label>
                        <input type="text" placeholder="Jln.Kemiren glagah" name="alamat" value="{{ old('alamat') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                    <div class="w-full">
                        <label class="font-semibold text-gray-500">Map Location<span
                                class="text-xs">(opsional)</span></label>
                        <input type="text" placeholder="Link google map" name="location" value="{{ old('location') }}"
                            class="px-3 py-3 placeholder-gray-300 w-full text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline" />
                    </div>
                </div>
                <div class="md:flex-row flex md:space-x-2 flex-col mt-5 md:mt-0">
                    <div class="w-full">
                        <label class="font-semibold bg-red-500 py-1 px-4 rounded-sm text-white shadow-sm"
                            id="show-pwd">Reset Password</label>
                        <input type="password" placeholder="password baru" name="password" id="password"
                            class="px-3 py-3 placeholder-gray-300 w-full mt-3 text-gray-600 relative bg-white rounded text-sm border border-gray-300 outline-none focus:outline-none focus:shadow-outline block" />
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
        $(document).ready(function() {
            setTimeout(function() {
                $('#alert').hide('slow')
            }, 5000);
            $("#password").hide();
            $(document).on('click', "#show-pwd", function() {
                $("#password").toggle('slow');
            })
            $(document).on('click', "#btn-edit", function() {
                let id = $(this).data('id');
                let token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "get",
                    url: "/admin/technician/" + id + "/edit",
                    data: {
                        "id": id
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#update-form").attr('action', "/admin/technician/" + id)
                        $("#update-form input[name='name']").val(response['name'])
                        $("#update-form input[name='email']").val(response['email'])
                        $("#update-form input[name='phone']").val(response['phone'])
                        $("#update-form input[name='alamat']").val(response['alamat'])
                        $("#update-form input[name='location']").val(response['location'])
                    }
                });
            });
        });
    </script>
@endsection
