<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css" integrity="sha512-85w5tjZHguXpvARsBrIg9NWdNy5UBK16rAL8VWgnWXK2vMtcRKCBsHWSUbmMu0qHfXW2FVUDiWr6crA+IFdd1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"
        integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/selectize.js"
        integrity="sha512-C0BjK7lFIReZXZeIPdlW5lV1926j4hons+B5UQhSqWee3cCNx/AB0jUC+v3XGMRucvipU4LrO6n7j1SujSQKYQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
</head>

<body class="text-gray-700 antialiased">
    <div class="root">
        <nav
            class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
            <div
                class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
                <button
                    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    type="button" onclick="toggleNavbar('example-collapse-sidebar')">
                    <i class="fas fa-bars"></i>
                </button>
                <img src="/img/logo-jmi.png" class="lg:w-24 w-16 md-20" alt="">
                <a href="/logout" class="md:hidden">Logout</a>
                <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
                    id="example-collapse-sidebar">
                    <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-200">
                        <div class="w-6/12 flex justify-end">
                            <button type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                onclick="toggleNavbar('example-collapse-sidebar')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="my-4 md:min-w-full hidden md:block" />
                    <x-Sidebar.heading title="Dashboard" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu active="{{ (request()->is('admin')) ? true:false }}" href="/admin">
                            <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                            Home
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/package"
                            active="{{ (request()->is('admin/package')) ? true:false }}">
                            <i class="fas fa-box-open mr-2 text-sm opacity-75"></i>
                            Paket
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/blok" active="{{ (request()->is('admin/blok')) ? true:false }}">
                            <i class="fa fa-map-marker mr-2 text-sm opacity-75"></i>
                            Blok
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/report"
                            active="{{ (request()->is('admin/report')) ? true:false }}">
                            <i class="fas fa-bug mr-2 text-sm opacity-75"></i>
                            Report
                        </x-Sidebar.menu>
                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="Teknisi" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu active="{{ (request()->is('admin/technician')) ? true:false }}"
                            href="/admin/technician">
                            <i class="fas fa-user-tie mr-2 text-sm opacity-75"></i>
                            Management Teknisi
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/salary"
                            active="{{ (request()->is('admin/salary')) ? true:false }}">
                            <i class="fas fa-hand-holding-usd mr-2 text-sm opacity-75"></i>
                            Gaji Teknisi
                        </x-Sidebar.menu>
                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="Inventory" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu href="/admin/expenditure"
                            active="{{ (request()->is('admin/expenditure')) ? true:false }}">
                            <i class="fas fa-truck mr-2 text-sm opacity-75"></i>
                            Pembelanjaan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/product"
                            active="{{ (request()->is('admin/product')) ? true:false }}">
                            <i class="fas fa-boxes mr-2 text-sm opacity-75"></i>
                            Barang
                        </x-Sidebar.menu>
                        {{-- <x-Sidebar.menu href="/admin/barangkeluar"
                            active="{{ (request()->is('admin/barangkeluar')) ? true:false }}"> <i
                                class="fas fa-truck-loading mr-2 text-sm opacity-75"></i>
                            barang keluar
                        </x-Sidebar.menu> --}}

                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="pelanggan" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu href="/admin/member"
                            active="{{ (request()->is('admin/member')) ? true:false }}">
                            <i class="fas fa-truck-moving mr-2 text-sm opacity-75"></i>
                            detail pelanggan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="{{ route('admin.payment.index') }}"
                            active="{{ (request()->is('admin/pembayaran')) ? true:false }}">
                            <i class="fas fa-boxes mr-2 text-sm opacity-75"></i>
                            pembayaran
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/installation"
                            active="{{ (request()->is('admin/installation')) ? true:false }}"> <i
                                class="fas fa-truck-loading mr-2 text-sm opacity-75"></i>
                            pasang baru
                        </x-Sidebar.menu>
                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                </div>
            </div>
        </nav>
        <div class="relative md:ml-64 bg-gray-50">
            {{-- Navbar --}}
            <nav
                class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
                <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="#">{{ $title
                        }}</a>

                    <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                        <div class="relative flex w-full flex-wrap items-stretch">
                            <span
                                class="z-10 h-full leading-snug font-normal text-center text-gray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i
                                    class="fas fa-search"></i></span>
                            <input type="text" placeholder="Search here..."
                                class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 relative  bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
                        </div>
                    </form>
                    <div class="dropdown hidden md:block">
                        <button class="relative w-10 h-10">
                            <div class="rounded-full bg-white h-full w-full"></div>
                        </button>
                        <div class="dropdown-items">
                            <ul>
                                <li><a href="#">Profile</a></li>
                                <li><a href="/logout">logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div class="flex flex-wrap">
                        @if ($title=="Welcome")
                        <x-cards.dasboard upper title="Pemasukan" subtitle="Rp.244" />
                        <x-cards.dasboard />
                        <x-cards.dasboard />
                        <x-cards.dasboard />
                        @endif
                       
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="/js/notus.js"></script>
    <script src="/js/script.js"></script>
    @yield("script")
</body>

</html>