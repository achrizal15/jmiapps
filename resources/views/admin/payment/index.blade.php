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
                            Pembayaran Bulanan
                        </h3>
                    </div>
                    <button class="font-semibold rounded-sm px-3 py-0.5 shadow-lg bg-blue-600 text-sm text-white"
                        id="btn-add" onclick="toggleModal('add-data')">ADD</button>
                </div>
                <div class="flex mt-2 w-full justify-center">
                    <form action="/admin/payment">
                        <div class="flex lg:space-x-2 flex-col lg:flex-row">
                            <div class="flex md:space-x-2 flex-col md:flex-row">
                                <input type="month" class="form-input " min="2015-01" value="{{ request('date') }}" name="date" id="">
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
                            @if(isset($_GET['search'])||isset($_GET['date']))
                            <a href="/admin/payment"
                                class="bg-red-500 text-center px-3 text-white flex items-center rounded-sm">Reset</a>@endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->
                <x-tables.table>
                    <x-tables.thead thItem="#,tanggal,Nama,paket,tagihan,status,action" />
                    <tbody>
                        @foreach ($payments as $item)
                        <tr>
                            <th
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left flex items-center font-bold text-gray-600">
                                {{ $loop->iteration+$payments->firstItem()-1}}
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{$item->created_at}}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->member->name }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                {{ $item->installations->package->name }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                @rupiah($item->installations->package->price)
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 p-4">
                                <x-tables.status sts="{{ $item->status }}" />
                            </td>
                            <td
                                class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600 font-semibold p-4 flex justify-between">
                                @if ($item->status=="pending"||$item->status=="rejected")
                                <div class="flex space-x-2 ">
                                    <button type="button" data-pay="{{ $item }}" id="btn-check"
                                        onclick="toggleModal('check-data')">
                                        <i class="fas fa-check text-yellow-500"></i>
                                    </button>
                                </div>
                                @endif
                                <button type="button" data-pay="{{ $item }}" id="btn-detail">
                                    <i class="fas fa-info-circle text-blue-500"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-tables.table>
            </div>
            <div class="mx-4 my-4"> {{ $payments->links('components.pagination.default') }}</div>
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
<x-modals.regular title="Pembayaran Bulanan" id="check-data">
    <form action="" method="post" class="check-form mx-4">
        @csrf
        @method('put')
        <h3>Bukti Transfer :</h3>
        <div class="flex justify-center items-center h-80">
            <img src="" alt="" class="max-h-full object-fill">
        </div>
        <div class="space-x-4 my-4">
            <button class="btn btn-success" name="status" value="accept">Terima</button><button class="btn btn-error"
                value="rejected" name="status">Tolak</button>
        </div>
    </form>
</x-modals.regular>

@endsection
@section('script')
<script>
    $(document).ready(function () {
     $(document).on("click","#btn-check", function () {
            let pay= $(this).data("pay");
            let id=pay['id']
            let img=pay['transfer_img'];
            $(".check-form").attr('action', "/admin/payment/"+id);
            $(".check-form img").attr("src", `{{ asset('storage/${img}') }}`);
        });
    });
</script>
@endsection