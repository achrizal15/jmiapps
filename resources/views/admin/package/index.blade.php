@extends('templates.admin')
@section('content')
<section class="px-4 md:px-10 mx-auto w-full -m-24">
    <article class="flex flex-wrap">
        <div class="w-full xl:w-8/12 xl:mb-0 mb-12 px-4 mt-4">
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
                                Paket
                            </h3>
                        </div>

                    </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <!-- Projects table -->
                    <x-tables.table>
                        <x-tables.thead thItem="#,nama,feature,price,action" />
                        <tbody>
                            @foreach ($packages as $item)
                            <tr>
                                <th
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm p-4 text-left font-bold text-gray-600">
                                    {{ $loop->iteration }}
                                </th>
                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600  p-4">
                                    {{ $item->name }}
                                </td>
                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600  p-4 w-60">
                                    <?php $fitur=explode(',',$item->feature); ?>
                                    <ol class="list-decimal">
                                        @foreach ($fitur as $i)
                                        <li> {{ $i}}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td
                                    class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm text-gray-600  p-4">
                                    @rupiah($item->price)
                                </td>
                                <td
                                    class="border-t-0 md:px-6 px-2 border-l-0 border-r-0 text-sm text-gray-600 ">
                                    <div class="justify-between flex items-center">
                                        <div class="has-tooltip inline-block">
                                            <span class="tooltip rounded-sm shadow-lg p-0.5 bg-gray-100 -mt-8 text-xs">
                                             {{$item->note}}
                                            </span>
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <form class="inline-block" action="/admin/package/{{ $item->id }}/edit">
                                            @csrf
                                            <button type="submit"> <i class="fas fa-edit text-yellow-500"></i></button>
                                        </form>
                                        <form action="/admin/package/{{ $item->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"> <i class="fas fa-trash text-red-500"></i></button>
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
        {{-- form --}}
        <div class="w-full xl:w-4/12 px-4 mt-4">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="p-4 flex-auto">
                    <h3 class="font-semibold text-lg text-gray-700 inline">
                        Tambah Paket
                    </h3>
                </div>
                {{-- FORM LAGI --}}
                <div class="p-4 flex-auto">
                    <form action="/admin/package" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="name-package">Nama Paket</label>
                            <input type="text" value="{{ old('name') }}" id="name-package" class="form-input w-full rounded-md"
                                placeholder="Premium example" name="name">
                            @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="price-package">Price</label>
                            <input type="number" value="{{ old('price') }}" id="price-package" class="form-input w-full rounded-md"
                                placeholder="150000" name="price">
                            @error('price')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="feature-package">Feature
                                <div class="has-tooltip inline-block">
                                    <span class="tooltip rounded-sm shadow-lg p-0.5 bg-gray-100 -mt-8 text-xs">
                                        Gunakan tanda koma (,) untuk memisahkan feature
                                    </span>
                                    <i class="fas align-top fa-exclamation text-xs"></i>
                                </div>
                            </label>
                            <textarea type="text" id="feature-package" class="form-input w-full rounded-md"
                                placeholder="Kecepatan 100/mbps,&#10;Kuota 3GB"
                                name="feature">{{ old('feature') }}</textarea>
                            @error('feature')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="note-package">Note</label>
                            <textarea name="note" id="note-package" placeholder="Biaya pemasangan berbeda setiap daerah"
                                class=" form-input w-full rounded-md">{{ old('note') }}</textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="px-4 py-1 bg-green-500 text-white font-semibold rounded-sm">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </article>

    @include('templates.footer')
</section>
@endsection
