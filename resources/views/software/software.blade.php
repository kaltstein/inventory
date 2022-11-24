@extends('layouts.app')

@section('content')
    <style>
        .dataTables_filter {
            margin-bottom: 8px;
        }
    </style>
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif


            <!-- drawer init and toggle -->
            <div class="text-right">
                <button id="create_drawer_btn"
                    class="text-white text-lg bg-green-700 rounded-full hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium  px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800"
                    type="button" data-drawer-target="drawer_create" data-drawer-show="drawer_create"
                    data-drawer-placement="right" aria-controls="drawer_create">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <table id="softwares_tbl"
                class=" hover  w-full text-xs md:text-sm  hover:cursor-pointer compact   text-gray-500 shadow-md row-border no-wrap"
                width="100%">
                <thead class="text-white bg-gray-700"></thead>
            </table>

            <!-- create drawer component -->
            <div id="drawer_create" class="hidden fixed z-40 h-screen p-4 overflow-y-auto bg-white w-80 dark:bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-right-label">
                <h5 id="drawer-label"
                    class="inline-flex items-center mb-6 text-base font-semibold text-gray-500  dark:text-gray-400">
                    <i class="fa-solid fa-plus"></i>&nbsp;CREATE
                </h5>
                <form class="mb-6 " method="POST" action="{{ route('software.create') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name
                        </label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="eg. Monitor" autocomplete="off" required>
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="FA_control_no"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">FA
                            Control#
                        </label>
                        <input type="text" id="FA_control_no" name="FA_control_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Service Tag" autocomplete="off">
                        @error('FA_control_no')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="stocks" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Stocks
                        </label>
                        <input type="number" id="stocks" name="stocks" step="1" min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Service Tag" autocomplete="off"
                            onkeydown="if(event.key==='.'){event.preventDefault();}"
                            oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                        @error('stocks')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="supplier"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Supplier
                        </label>
                        <input type="text" id="supplier" name="supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Supplier" autocomplete="off">
                        @error('supplier')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="contract_no"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contract#
                        </label>
                        <input type="text" id="contract_no" name="contract_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Contract No." autocomplete="off">
                        @error('contract_no')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="remarks"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remarks
                        </label>
                        <textarea type="text" id="remarks" name="remarks"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Remarks" autocomplete="off"></textarea>
                        @error('remarks')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="FA_control_no"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Valid Until

                        </label>
                        <input type="date" id="expiry_date" name="expiry_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Service Tag" autocomplete="off">
                        @error('expiry_date')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="text-white justify-center flex items-center bg-green-700 hover:bg-green-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-plus"></i>&nbsp;CREATE</button>
                </form>
            </div>

        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.software-nav').addClass('text-blue-500');
            var softwares_tbl = $('#softwares_tbl').DataTable({

                scrollX: true,
                scrollY: true,
                ajax: "{{ route('software.list') }}",
                // colReorder: true,

                // processing: true,
                // serverSide: true,

                "lengthChange": false,
                "pageLength": 15,
                columns: [{
                        data: 'id',
                        title: 'ID',
                        className: 'dt-right'
                    },
                    {
                        data: 'contract_no',
                        title: 'CONTRACT#',
                        className: 'dt-right'
                    },

                    {
                        data: 'name',
                        title: 'NAME',
                        render: function(data, type) {
                            return "<span class='font-bold text-gray-700 '> " + data +
                                "</span>"
                        }
                    },
                    {
                        data: 'current_users',
                        title: 'CURRENT USERS',
                        render: function(data, type) {
                            return "<span class='font-bold text-gray-700 '> " + data +
                                "</span>"
                        }
                    },
                    {
                        data: 'FA_control_no',
                        title: 'FA CONTROL#',
                        className: 'dt-right'
                    },
                    {
                        data: 'stocks',
                        title: 'STOCKS',
                        className: 'dt-right'
                    },
                    {
                        data: 'spare',
                        title: 'SPARE',
                        className: 'dt-right',
                        render: function(data, type) {
                            if (data == 0) {
                                return "<span class='font-bold text-red-700 '> " + data +
                                    "</span>";
                            } else {
                                return "<span class='font-bold text-green-700 '> " + data +
                                    "</span>";
                            }

                        }
                    },
                    {
                        data: 'supplier',
                        title: 'SUPPLIER',
                    },

                    {
                        data: 'remarks',
                        title: 'REMARKS',
                    },

                    {
                        data: 'expiry_date',
                        title: 'RELEASED AT',
                        className: 'text-right',
                        render: function(data, type) {

                            if (data != null) {
                                return moment(data).format('MMM DD, YYYY');
                            } else {
                                return "";
                            }

                        }
                    },
                    {
                        data: 'updated_at',
                        title: 'UPDATED AT',
                        className: 'text-right',
                        render: function(data, type) {

                            if (data != null) {
                                return moment(data).format('MMM DD, YYYY hh:mm:ss a');
                            } else {
                                return "";
                            }

                        }
                    },

                ],
                "columnDefs": [{
                    "targets": [1, 2],
                    "orderable": false
                }]
            });

            $('#create_drawer_btn').click(function(e) {
                $("#drawer_create").removeClass('hidden');
            });


        });
    </script>
@endsection
