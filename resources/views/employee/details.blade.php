@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10 bg-white p-5 h-screen shadow-lg">
        <div class="w-full sm:px-6">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif


            <header class="mb-6">
                <ul class="font-bold text-gray-700">
                    <li class="  pb-2">
                        <i class="fa-solid fa-user-tie"></i>
                        {{ $user_details->name }}
                    </li>
                    <li class="  pb-2">
                        <i class="fa-solid fa-building-user"></i>
                        {{ $user_details->department->name }}
                    </li>
                    <li class="  pb-2">
                        <i class="fa-solid fa-people-group"></i>
                        {{ $user_details->team->name }}
                    </li>
                    <li class="  pb-2">

                        <i class="fa-solid fa-square-envelope"></i>
                        {{ $user_details->email_type }}
                    </li>
                    <li class="  pb-2">
                        <i class="fa-solid fa-envelopes-bulk"></i>
                        {{ $user_details->email_distribution }}
                    </li>
                    <li class="  pb-2">
                        <i class="fa-solid fa-fingerprint"></i>
                        {{ $user_details->biometric_id }}
                    </li>
                    <li class="  pb-2">
                        <i class="fa-solid fa-print"></i>
                        {{ $user_details->printer_id }}
                    </li>
                    <li class="  pb-2">
                        <i class="fa-solid fa-border-all"></i>
                        {{ $user_details->utm_type }}
                    </li>
                </ul>
                <hr>
            </header>

            <div class="flex space-x-2 ">
                <div
                    class=" w-1/2 text-sm font-medium text-gray-900 bg-white software border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <button aria-current="true" type="button"
                        class="text-center py-2 px-4 w-full font-medium  text-white bg-gray-700 software-lg border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600">
                        <i class="fa-solid fa-desktop"></i> HARDWARE
                    </button>

                    @foreach ($user_details->hardwares as $hardware)
                        <div
                            class="py-2 px-4 w-full cursor-pointer hover:bg-gray-100 hover:text-blue-600 border-b border-gray-200">
                            @if ($hardware->name == 'MONITOR')
                                <i class="fa-solid fa-computer-mouse"></i>
                            @elseif($hardware->name == 'MOUSE')
                                <i class="fa-solid fa-desktop"></i>
                            @elseif($hardware->name == 'KEYBOARD')
                                <i class="fa-solid fa-keyboard"></i>
                            @elseif($hardware->name == 'HEADSET')
                                <i class="fa-solid fa-headset"></i>
                            @elseif($hardware->name == 'WEBCAM')
                                <i class="fa-solid fa-video"></i>
                            @endif
                            {{ $hardware->name }}
                            <br>
                            <small> {{ $hardware->asset_no }}</small>
                            <small> {{ $hardware->brand }}</small>
                            <small> {{ $hardware->specs }}</small>
                            <small> {{ $hardware->serial_no }}</small>
                        </div>
                    @endforeach

                </div>
                <div
                    class="w-1/2 text-sm font-medium text-gray-900 bg-white software border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <button aria-current="true" type="button"
                        class="py-2 px-4 w-full font-medium text-center text-white bg-gray-700 software-lg border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600">
                        <i class="fa-brands fa-windows"></i> SOFTWARES
                    </button>


                    @foreach ($user_details->softwares as $software)
                        <div
                            class="py-2 px-4 w-full cursor-pointer hover:bg-gray-100 hover:text-blue-600 border-b border-gray-200 ">

                            {{ $software->software->name }}
                            <br>
                            <small> Valid Until:
                                {{ \Carbon\Carbon::parse($software->software->expiry_date)->format('m/d/Y') }}</small>

                        </div>
                    @endforeach

                </div>
            </div>







        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.employee-nav').addClass('text-blue-500');


        });
    </script>
@endsection
