<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />

    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <x-Sidebar.menu href="/pemilik/agreement"
                            active="{{ request()->is('pemilik/agreement') ? true : false }}">
                            <i class="fas fa-truck mr-2 text-sm opacity-75"></i>
                            Pembelanjaan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/pemilik/finance"
                            active="{{ request()->is('pemilik/finance') ? true : false }}">
                            <i class="fas fa-money-bill-alt mr-2 text-sm opacity-75"></i>
                            Keuangan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/pemilik/installation"
                            active="{{ request()->is('pemilik/installation') ? true : false }}">
                            <i class="fa-solid fa-code-pull-request mr-2 text-sm opacity-75"></i>
                       Installation
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/pemilik/pembayaran"
                            active="{{ request()->is('pemilik/pembayaran') ? true : false }}">
                            <i class="fas fa-file-invoice mr-2 text-sm opacity-75"></i>
                       pembayaran
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/pemilik/salary"
                            active="{{ request()->is('pemilik/salary') ? true : false }}">
                            <i class="fas fa-hand-holding-usd mr-2 text-sm opacity-75"></i>
                       gaji
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
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
                        href="#">{{ $title }}</a>

                    <div class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3">
                        <div class="relative flex w-full text-white flex-wrap items-stretch">
                            {{ auth()->user()->name }}
                        </div>
                    </div>
                    <div class="dropdown hidden md:block">
                        <button class="relative w-10 h-10">
                            <div class="rounded-full bg-white h-full w-full"></div>
                        </button>
                        <div class="dropdown-items">
                            <ul>
                                <li><a href="/logout">logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div class="flex flex-wrap">
                        @if ($title == 'Welcome')
                            <x-cards.dasboard upper title="INSTALASI" subtitle="{{ $total_psb }} PSB"
                                icon="fas fa-money-bill-alt" />
                            <x-cards.dasboard title="Member" upper subtitle="{{ $total_member }} MEMBER"
                                icon="fas fa-user-friends" />
                            <x-cards.dasboard title="TEKNISI" upper subtitle="{{ $total_teknisi }} TEKNISI"
                                icon="fas fa-users-cog" />
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="/js/notus.js"></script>
    <script src="/js/admin.js"></script>
</body>

</html>
