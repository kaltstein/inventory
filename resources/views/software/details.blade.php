@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10 bg-white p-5 h-screen shadow-lg">
        <div class="w-full h-full sm:px-6 ">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif


            <header class="mb-6">
                <ul class="">
                    <li class="font-bold text-gray-700 pb-2 text-lg">

                        {{ $software_details->FA_control_no }}
                    </li>
                    <li class="font-bold text-gray-700 pb-2">
                        <i class="fa-brands fa-windows"></i>
                        {{ $software_details->name }}
                    </li>
                    <li class="font-bold text-gray-700 pb-2">
                        <i class="fa-solid fa-box-open"></i>
                        Stocks: {{ $software_details->stocks }}
                    </li>
                    <li class="font-bold text-gray-700 pb-2">
                        <i class="fa-solid fa-heart"></i>
                        @if ($software_details->stocks - count($software_details->user_softwares) == 0)
                            <span class="text-red-700">Spare:
                                {{ $software_details->stocks - count($software_details->user_softwares) }}</span>
                        @else
                            <span class="text-green-700">Spare:
                                {{ $software_details->stocks - count($software_details->user_softwares) }}</span>
                        @endif


                    </li>


                    <li class="font-bold text-gray-700 pb-2">
                        <i class="fa-solid fa-truck-fast"></i>
                        {{ $software_details->supplier }}
                    </li>

                    <li class="font-bold text-gray-700 pb-2">
                        <i class="fa-solid fa-calendar-xmark"></i>
                        Valid Until: {{ \Carbon\Carbon::parse($software_details->expiry_date)->format('m/d/Y') }}</small>
                    </li>
                </ul>
                <hr>
            </header>
            <form class="mb-6 " method="POST" action="{{ route('software.assign') }}">
                @csrf
                <input type="hidden" value="{{ $software_details->id }}" name="id">
                <div
                    class="w-full  h-3/4 overflow-auto text-sm font-medium text-gray-900 bg-white software border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white ">
                    <button aria-current="true" type="button"
                        class="py-2 px-4 w-full font-medium text-center text-white bg-gray-700 software-lg border-b border-gray-200 cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-600">
                        <i class="fa-brands fa-windows"></i> CURRENT USER
                    </button>

                    @foreach ($software_details->user_softwares as $user_softwares)
                        <div
                            class="py-2 px-4 w-full cursor-pointer hover:bg-gray-100 hover:text-blue-600 border-b border-gray-200 ">

                            <small class="mx-2"> {{ $user_softwares->current_users->team->name }}</small>

                            <select type="text" id="user_id" name="user_id[]"
                                class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">None</option>
                                @foreach ($users as $user)
                                    @if ($user_softwares->current_users->id == $user->id)
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror


                            <textarea type="text" id="remarks" name="remarks[]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Remarks" autocomplete="off">{{ $user_softwares->remarks }}</textarea>
                        </div>
                    @endforeach


                    @for ($i = 0; $i < $software_details->stocks - count($software_details->user_softwares); $i++)
                        <div
                            class="py-2 px-4 w-full cursor-pointer hover:bg-gray-100 hover:text-blue-600 border-b border-gray-200 ">
                            <div class="mb-6">
                                <label for="user_id"
                                    class="block mb-2 text-sm font-medium text-green-900 dark:text-gray-300">Assign
                                </label>
                                <select type="text" id="user_id" name="user_id[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">None</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                @enderror
                                <label for="remarks"
                                    class="block mb-2 text-sm font-medium text-green-900 dark:text-gray-300">Remarks
                                </label>
                                <textarea type="text" id="remarks" name="remarks[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Remarks" autocomplete="off"></textarea>
                            </div>
                        </div>
                    @endfor

                </div>

                <button type="submit"
                    class="mt-5 float-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                    <i class="fa-solid fa-floppy-disk"></i>&nbsp;SAVE
                </button>
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.software-nav').addClass('text-blue-500');


        });
    </script>
@endsection
