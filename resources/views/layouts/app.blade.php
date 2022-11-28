<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Styles -->
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{ asset('data-table/datatables.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

</head>

<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="">
            @if (Auth::check())
                <nav class="px-2 bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700 shadow-md">
                    <div class="container flex flex-wrap items-center justify-between mx-auto">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('images/logo.png') }}" class="h-6 mr-3 sm:h-10" alt="Flowbite Logo" />
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Inventory
                                System</span>
                        </a>
                        <button data-collapse-toggle="navbar-dropdown" type="button"
                            class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="navbar-dropdown" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                            <ul
                                class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                                <li>
                                    <a href="{{ route('mac') }}"
                                        class="mac-nav block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">MAC
                                        CPU
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('employee') }}"
                                        class="employee-nav block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">EMPLOYEES
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('hardware') }}"
                                        class="hardware-nav block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">HARDWARES
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('software') }}"
                                        class="software-nav block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">SOFTWARES
                                    </a>
                                </li>

                                <li class=" text-red-700">
                                    <a href="{{ route('logout') }}"
                                        class=" logout-nav block py-2 pl-3 pr-4  rounded hover:font-bold hover:bg-gray-100 md:hover:bg-transparent md:border-0  md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i
                                            class="fa-solid fa-power-off"></i> {{ __('LOGOUT') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                </li>



                            </ul>
                        </div>
                    </div>
                </nav>
            @endif



        </header>

        @yield('content')
    </div>

    <script src="{{ asset('data-table/datatables.min.js') }}"></script>

    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <script src="{{ asset('moment-js/moment.js') }}"></script>
</body>

</html>
