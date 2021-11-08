@extends('templates.teknisi')
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
                        <div class="text-sm breadcrumbs">
                            <ul>
                                <li>
                                    <a href="/">Teknisi</a>
                                </li>
                                <li>
                                    <a href="/teknisi/installation">Installation</a>
                                </li>
                                <li>{{ $title }} Now</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block w-full pb-5">
                <!-- Projects table -->
                <form action="">
                    <div class="grid lg:grid-cols-2 lg:gap-4">
                        <div class="p-4">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Username</span>
                                </label>
                                <input type="text" placeholder="username" name="username" class="input input-bordered"
                                    required>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Google map</span>
                                </label>
                                <input type="text" name="location"
                                    placeholder="Q9C7+8H9, Taman Baru, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68416"
                                    class="input input-bordered" required>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Nama paket</span>
                                </label>
                                <input type="text" value="{{ $installation->package->name }}"
                                    class="input input-bordered input-disabled" disabled>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Harga Paket</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input type="text" value="@rupiah($installation->package->price)"
                                        class="input input-bordered input-disabled w-full rounded-md" disabled>
                                </label>
                            </div>

                        </div>
                        <div class="p-4">
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Redaman</span>
                                </label>
                                <input type="text" name="redaman" placeholder="" class="input input-bordered" required>
                            </div>
                            <div class="flex lg:flex-row flex-col justify-between w-full">
                                <div class="form-control lg:w-1/3 w-full">
                                    <label class="label">
                                        <span class="label-text">Spliter</span>
                                    </label>
                                    <input type="text" name="spliter" placeholder="" class="input input-bordered"
                                        required>
                                </div>
                                <div class="form-control lg:w-1/5 w-full">
                                    <label class="label">
                                        <span class="label-text">Port</span>
                                    </label>
                                    <input type="text" name="port" placeholder="" class="input input-bordered" required>
                                </div>
                                <div class="form-control lg:w-1/3 w-full">
                                    <label class="label">
                                        <span class="label-text">Number modem</span>
                                    </label>
                                    <input type="text" name="number_modem" placeholder="" class="input input-bordered"
                                        required>
                                </div>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Biaya pemasangan</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input type="text" name="installation_costs" placeholder="500000"
                                        class="input input-bordered w-full rounded-md" required>
                                </label>
                            </div>
                            <div class="form-control w-full">
                                <label class="label">
                                    <span class="label-text">Discount</span>
                                </label>
                                <label class="input-group rounded-md">
                                    <span>Rp</span>
                                    <input type="text" name="discount" placeholder="20000"
                                        class="input input-bordered w-full rounded-md" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-info ml-4">Gunakan inventori</button>
                    <div class="px-4 overflow-x-auto">
                        <table class="table w-full table-zebra mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">No data</td>
                                    {{-- <th>1</th>
                                    <td>Lesya Tinham</td>
                                    <td>2</td>
                                    <td>Rp.@rupiah(123812)</td>
                                    <td>DELETE EDIT</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end px-4 items-center">
                        <label>Total : </label>
                        <input type="text" disabled class="form-input ml-2" placeholder="000">
                        <a href="/teknisi/installation" class="btn btn-error ml-4">Back</a>
                        <button class="btn btn-success ml-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('templates.footer')
</section>

@endsection