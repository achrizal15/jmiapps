<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token" content="{{  csrf_token() }}">
    <script src="/js/templates/jquery.min.js"></script>
    <script src="/js/templates/validate-form.js"></script>
    <link rel="stylesheet" href="/css/templates/select2.min.css" />
    <script src="/js/templates/select2.min.js"></script>
    <script src="/js/templates/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />
    <script type="text/javascript" src="/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" href="/fontawesome/css/all.min.css" />
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <title>{{ $title }}</title>
</head>

<body class="text-gray-700 antialiased">
    <div id="loading-loader" class="bg-black bg-opacity-5 h-screen w-full z-50 fixed hidden">
        <div class="flex justify-center items-center h-full">
            <div class="
            animate-spin
            rounded-full
            h-32
            w-32
            border-t-2 border-b-2 border-purple-500
          "></div>
        </div>
    </div>

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
                        <x-Sidebar.menu active="{{ (request()->is('teknisi')) ? true:false }}" href="/teknisi">
                            <i class="fas fa-tv mr-2 text-sm opacity-75"></i>
                            Home
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/teknisi/installation"
                            active="{{ (request()->is('teknisi/installation')) ? true:false }}">
                            <i class="fas fa-box-open mr-2 text-sm opacity-75"></i>
                            Pemasangan Baru
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/teknisi/penagihan"
                            active="{{ (request()->is('teknisi/penagihan')) ? true:false }}">
                            <i class="fa fa-map-marker mr-2 text-sm opacity-75"></i>
                            Penagihan bulanan
                        </x-Sidebar.menu>
                        <x-Sidebar.menu href="/teknisi/report"
                            active="{{ (request()->is('teknisi/report')) ? true:false }}">
                            <i class="fas fa-bug mr-2 text-sm opacity-75"></i>
                            Report
                        </x-Sidebar.menu>
                    </x-Sidebar.navigasi>
                </div>
            </div>
        </nav>
        <div class="relative md:ml-64 bg-gray-50">
            {{-- Navbar --}}
            <nav
                class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
                <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="#">{{
                        $title}}</a>

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
                                <li><a href="#">Profile</a></li>
                                <li><a href="/logout">logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="relative bg-blue-800 md:pt-32 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div class="flex flex-wrap">
                        @if ($title=="Dashboard")
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
    <script src="/js/notus.js"></script>
    <script src="/js/teknisi.js"></script>
</body>

</html>