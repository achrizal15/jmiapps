@extends('templates.teknisi')
@section('content')
<div class="px-20 py-20">
    <h1 class="font-bold">Nama Teknisi:{{ $teknisi }}</h1>
    <a href="/logout">Logout</a>
    <article class="mt-10">
        <h1 class="font-semibold">Daftar Pemasangan Baru</h1>
        <table class="mt-5 table-auto border border-collapse">
            <thead>
                <tr>
                    <th class="border">
                        Nama Pelanggan
                    </th>
                    <th class="border">
                        Alamat
                    </th>
                    <th class="border">
                        Phone
                    </th>
                    <th class="border">
                        Package
                    </th>
                    <th class="border">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($psb as $item)
                <tr>
                    <td class="border p-2">{{ $item->user->name }}</td>
                    <td class="border p-2">{{ $item->user->alamat }}</td>
                    <td class="border p-2">{{ $item->user->phone }}</td>
                    <td class="border p-2">{{ $item->package->name }}</td>
                    <td class="border p-2">
                        <a class="px-4 py-1 rounded-sm bg-green-500 text-white"
                            href="/teknisi/{{ $item->id }}/edit">Pasang</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </article>
</div>
@endsection
