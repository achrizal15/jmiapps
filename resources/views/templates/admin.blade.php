<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/templates/jquery.min.js"></script>
    <script src="/js/templates/validate-form.js"></script>
    <link rel="stylesheet" href="/css/templates/select2.min.css" />
    <script src="/js/templates/select2.min.js"></script>
    <script src="/js/templates/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />
    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>
    <script src="/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <title>{{ $title }}</title>
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
                <img src="/img/logo.png" class="md:-mb-5 w-16 md:w-32" alt="">
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
                        <x-Sidebar.menu active="{{ request()->is('admin') ? true : false }}" href="/admin">
                            <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                            Home
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/package"
                            active="{{ request()->is('admin/package') ? true : false }}">
                            <i class="fas fa-box-open mr-2 text-sm opacity-75"></i>
                            Paket
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/blok" active="{{ request()->is('admin/blok') ? true : false }}">
                            <i class="fa fa-map-marker mr-2 text-sm opacity-75"></i>
                            Blok
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/report"
                            active="{{ request()->is('admin/report') ? true : false }}">
                            <i class="fas fa-bug mr-2 text-sm opacity-75"></i>
                            Report
                        </x-Sidebar.menu>
                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="Teknisi" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu active="{{ request()->is('admin/technician') ? true : false }}"
                            href="/admin/technician">
                            <i class="fas fa-user-tie mr-2 text-sm opacity-75"></i>
                            Management Teknisi
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/salary"
                            active="{{ request()->is('admin/salary') ? true : false }}">
                            <i class="fas fa-hand-holding-usd mr-2 text-sm opacity-75"></i>
                            Gaji Teknisi
                        </x-Sidebar.menu>
                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="Inventory" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu href="/admin/expenditure"
                            active="{{ request()->is('admin/expenditure') ? true : false }}">
                            <i class="fas fa-truck mr-2 text-sm opacity-75"></i>
                            Pembelanjaan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/product"
                            active="{{ request()->is('admin/product') ? true : false }}">
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
                            active="{{ request()->is('admin/member') ? true : false }}">
                            <i class="fas fa-truck-moving mr-2 text-sm opacity-75"></i>
                            detail pelanggan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="{{ route('admin.payment.index') }}"
                            active="{{ request()->is('admin/payment') ? true : false }}">
                            <i class="fas fa-file-invoice mr-2 text-sm opacity-75"></i>
                            pembayaran
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/installation"
                            active="{{ request()->is('admin/installation') ? true : false }}">
                            <i class="fa-solid fa-code-pull-request mr-2 text-sm opacity-75"></i>
                           Pasang Baru
                        </x-Sidebar.menu>

                        {{-- <li class="items-center">
                            <details onclick="initShowDropdown(this)" class="open:bg-blue-200 p-3 rounded-md"
                                {{ request()->is('admin/installation') || request()->is('admin/installation-report') ? 'open' : '' }}>
                                <summary
                                    class="text-xs uppercase cursor-pointer font-bold justify-between flex text-gray-500 hover:text-blue-800 w-full   {{ request()->is('admin/installation') || request()->is('admin/installation-report') ? 'text-blue-800' : '' }}">
                                    <span>
                                        <i class="fa-solid fa-code-pull-request mr-2 text-sm opacity-75"></i>
                                        pasang baru
                                    </span>
                                    <i class="fa-solid fa-plus mr-2 text-sm opacity-75"></i>
                                </summary>
                                <div class="space-y-3 ml-6 text-xs uppercase text-gray-500 mt-2">
                                    <a class="block hover:text-blue-800 {{ request()->is('admin/installation') ? 'text-blue-800' : '' }}"
                                        href="/admin/installation">Panel INSTALASI</a>
                                    <a class="block hover:text-blue-800 {{ request()->is('admin/installation-report') ? 'text-blue-800' : '' }}"
                                        href="">Laporan</a>
                                </div>
                            </details>
                        </li> --}}

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
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                        href="#">{{ $title }}</a>

                    <div class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                        <div class="relative flex w-full text-white flex-wrap items-stretch">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <div class="dropdown hidden md:block">
                        <button class="relative w-10 h-10">
                            <div class="rounded-full bg-white h-full w-full overflow-hidden">
                                <img src="/img/default-user.png" alt="">
                            </div>
                        </button>
                        <div class="dropdown-items">
                            <ul>
                                <li><a href="/admin/profile">Profile</a></li>
                                <li><a href="/logout">logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="relative bg-blue-800 md:pt-32 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div class="flex flex-wrap">
                        @if ($title == 'Welcome')
                            <x-cards.dasboard upper title="INSTALASI" subtitle="{{ $total_psb }} PSB" icon="fas fa-money-bill-alt"/>
                            <x-cards.dasboard title="Member" upper subtitle="{{ $total_member }} MEMBER" icon="fas fa-user-friends" />
                            <x-cards.dasboard title="TEKNISI" upper subtitle="{{ $total_teknisi }} TEKNISI" icon="fas fa-users-cog" />
                        @endif

                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="/js/notus.js"></script>
    <script src="/js/admin.js?v=20211212"></script>
</body>

</html>
