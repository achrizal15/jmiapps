<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/app.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <title>{{ $title }}</title>
    @yield('style')
</head>

<body class="text-blueGray-700 antialiased">
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
                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="Inventory" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu href="/admin/supplier"
                            active="{{ (request()->is('admin/supplier')) ? true:false }}">
                            <i class="fas fa-truck-moving mr-2 text-sm opacity-75"></i>
                            supplier
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/inventory"
                            active="{{ (request()->is('admin/inventory')) ? true:false }}">
                            <i class="fas fa-boxes mr-2 text-sm opacity-75"></i>
                            tambah stok
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/barangkeluar"
                            active="{{ (request()->is('admin/barangkeluar')) ? true:false }}"> <i
                                class="fas fa-truck-loading mr-2 text-sm opacity-75"></i>
                            barang keluar
                        </x-Sidebar.menu>

                    </x-Sidebar.navigasi>
                    <hr class="my-4 md:min-w-full" />
                    <x-Sidebar.heading title="pelanggan" />
                    <x-Sidebar.navigasi>
                        <x-Sidebar.menu href="/admin/pelanggan"
                            active="{{ (request()->is('admin/pelanggan')) ? true:false }}">
                            <i class="fas fa-truck-moving mr-2 text-sm opacity-75"></i>
                          detail pelanggan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/pembayaran"
                            active="{{ (request()->is('admin/pembayaran')) ? true:false }}">
                            <i class="fas fa-boxes mr-2 text-sm opacity-75"></i>
                            pembayaran
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/admin/pasangbaru"
                            active="{{ (request()->is('admin/pasangbaru')) ? true:false }}"> <i
                                class="fas fa-truck-loading mr-2 text-sm opacity-75"></i>
                          pasang baru
                        </x-Sidebar.menu>

                    </x-Sidebar.navigasi>
                </div>
            </div>
        </nav>
        <div class="relative md:ml-64 bg-blueGray-50">
            {{-- Navbar --}}
            <nav
                class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
                <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                        href="#">{{ $title }}</a>

                    <form class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                        <div class="relative flex w-full flex-wrap items-stretch">
                            <span
                                class="z-10 h-full leading-snug font-normal text-center text-gray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"><i
                                    class="fas fa-search"></i></span>
                            <input type="text" placeholder="Search here..."
                                class="border-0 px-3 py-3 placeholder-gray-300 text-gray-600 relative  bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10" />
                        </div>
                    </form>
                    <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                        <a class="text-blueGray-500 block" href="#" onclick="openDropdown(event,'user-dropdown')">
                            <div class="items-center flex">
                                <div class="relative w-12 h-12">
                                    <img class="rounded-full border-2 border-gray-100 shadow-sm"
                                        src="https://randomuser.me/api/portraits/women/81.jpg" alt="user image" />
                                </div>
                            </div>
                        </a>
                        <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                            id="user-dropdown">
                            <a href="/admin/profile"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Profile</a>
                            <a href="/logout"
                                class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">Logout</a>
                        </div>
                    </ul>
                </div>
            </nav>
            <div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="/js/notus.js"></script>
</body>

</html>