<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="/fontawesome/js/all.min.js" ></script>
    <script src="/js/templates/jquery.min.js"></script>    
    <link rel="stylesheet" href="/css/templates/select2.min.css" />
    <script src="/js/templates/select2.min.js"></script>
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
</head>

<body class="text-gray-700 antialiased">
    <div class="fixed bottom-5 right-5"><a href="https://wa.me/082227344311"
        class="mx-auto lg:mx-0 text-2xl text-green-500  focus:outline-none">
        <i class="fa fa-whatsapp rounded-full p-4 bg-white shadow-lg " aria-hidden="true"></i>
    </a></div>
    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">


        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

            <div class="w-1/2 pl-2 md:pl-0">
                <a class="text-red-800 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#">
                    ThulikNet
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative float-right">
                    <div class="relative text-sm">
                        <button id="userButton" class="flex items-center focus:outline-none mr-3">
                            <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of User">
                            <span class="hidden md:inline-block">Hi,
                                {{ implode(array_slice(explode(" ", auth()->user()->name), 0, 1))}} </span>
                            <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129"
                                xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path
                                        d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                </g>
                            </svg>
                        </button>
                        <div id="userMenu"
                            class="bg-white rounded shadow-md absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                            <ul class="list-reset">
                                <li><a href="#"
                                        class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">My
                                        account</a></li>
                                <li><a href="#"
                                        class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Notifications</a>
                                </li>
                                <li>
                                    <hr class="border-t mx-2 border-gray-400">
                                </li>
                                <li><a href="/logout"
                                        class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="block lg:hidden pr-4">
                        <button id="nav-toggle"
                            class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white z-20"
                id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a href="/pelanggan" @if (request()->is("pelanggan")) class="block py-1 md:py-3 pl-1
                            align-middle text-yellow-600 no-underline hover:text-gray-900
                            border-b-2 border-yellow-600 hover:border-yellow-600"
                            @else
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900
                            border-b-2 border-white hover:border-yellow-600"
                            @endif
                            >
                            <i class="fas fa-home fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Home</span>
                        </a>
                    </li>

                    <li class="mr-6 my-2 md:my-0 hidden">
                        <a href="/pelanggan/information" @if (request()->is("pelanggan/information"))
                            class="block py-1 md:py-3 pl-1 align-middle text-purple-500 no-underline hover:text-gray-900
                            border-b-2 border-purple-500"
                            @else
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900
                            border-b-2 border-white hover:border-purple-500"
                            @endif
                            >
                            <i class="fa fa-envelope fa-fw mr-3"></i><span
                                class="pb-1 md:pb-0 text-sm">Information</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="/pelanggan/payment" @if (request()->is('pelanggan/payment'))
                            class="block py-1 md:py-3 pl-1 align-middle text-red-500 no-underline hover:text-gray-900
                            border-b-2 border-red-500"
                            @else
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900
                            border-b-2 border-white hover:border-red-500">
                            @endif
                            <i class="fa fa-wallet fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Payments</span>
                        </a>
                    </li>
                </ul>
                <div class="dropdown relative pull-right pl-4 pr-4 md:pr-0 mr-3 text-gray-500 hover:text-gray-900">
                    <div tabindex="0" class="m-1"> <i class="fas fa-bell mr-3"></i></i><button
                            class="pb-1 md:pb-0 text-sm">Notification</button>
                    </div>
                    <ul tabindex="0"
                        class="p-2 lg:right-0  shadow menu dropdown-content relative bg-base-100 rounded-box w-52 max-h-52 ">
                        @if (!count($message))
                        Tidak ada notifikasi
                        @else
                        <div class="fixed top-2 b-0 text-red-500">
                            <form action="/pelanggan/dashboard/report/{{ auth()->user()->id }}" method="POST">
                                @csrf
                                @method("delete")
                                <button type="submit">Clear All</button>
                            </form>
                        </div>
                        <div class="max-h-52 mt-8 overflow-y-auto text-xs">
                            @foreach ($message as $item)
                            <li class="mb-2">
                                <div class="grid grid-cols-5 gap-4">
                                    <div> <img class="w-5 h-5 rounded-full" src="https://style.anu.edu.au/_anu/4/images/placeholders/person_8x10.png" alt="Avatar of User"></div>
                                    <div class="col-span-4">{{ $item->name}}</div>
                                  </div></li>
                            @endforeach
                        </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="container w-full mx-auto pt-20">

        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            @yield('content')

        </div>


    </div>
    <!--/container-->


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="/js/notus.js"></script>
    <script>
        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");

        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("invisible")) {
                        userMenuDiv.classList.remove("invisible");
                    } else {
                        userMenuDiv.classList.add("invisible");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("invisible");
                }
            }

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }

        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>
    @yield('script')
</body>

</html>