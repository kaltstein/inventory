@extends('layouts.app')

@section('content')
    <style>
        .dataTables_filter {
            margin-bottom: 8px;
        }
    </style>
    <main class="sm:container sm:mx-auto sm:mt-10 bg-white p-5 h-screen shadow-lg">
        <div class="w-full sm:px-6">

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <i class="fa-solid fa-circle-check"></i> <span class="font-medium"> {{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                    role="alert">
                    <i class="fa-solid fa-xmark"></i> <span class="font-medium">Error !</span> {{ session('error') }}
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

            <!-- drawer component -->
            <div id="drawer_edit" class="hidden fixed z-40 h-screen p-4 overflow-y-auto bg-white w-80 dark:bg-gray-800"
                tabindex="-1" aria-labelledby="drawer-right-label">
                <h5 id="drawer-label"
                    class="inline-flex items-center mb-6 text-base font-semibold text-gray-500  dark:text-gray-400">
                    <i class="fa-solid fa-pen"></i>&nbsp;EDIT
                </h5>
                <form class="mb-6 " method="POST" action="{{ route('software.update') }}">
                    @csrf
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="mb-6">
                        <label for="edit_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name
                        </label>
                        <input type="text" id="edit_name" name="edit_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="eg. Monitor" autocomplete="off" required>
                        @error('edit_name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="edit_contract_no"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contract#
                        </label>
                        <input type="text" id="edit_contract_no" name="edit_contract_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Contract No." autocomplete="off">
                        @error('edit_contract_no')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="edit_FA_control_no"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">FA
                            Control#
                        </label>
                        <input type="text" id="edit_FA_control_no" name="edit_FA_control_no"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Control No." autocomplete="off">
                        @error('edit_FA_control_no')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="edit_stocks"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Stocks
                        </label>
                        <input type="number" id="edit_stocks" name="edit_stocks" step="1" min="0"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Service Tag" autocomplete="off"
                            onkeydown="if(event.key==='.'){event.preventDefault();}"
                            oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                        @error('edit_stocks')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="edit_supplier"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Supplier
                        </label>
                        <input type="text" id="edit_supplier" name="edit_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Supplier" autocomplete="off">
                        @error('edit_supplier')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="edit_remarks"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remarks
                        </label>
                        <textarea type="text" id="edit_remarks" name="edit_remarks"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Remarks" autocomplete="off"></textarea>
                        @error('edit_remarks')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="edit_expiry_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Valid Until

                        </label>
                        <input type="date" id="edit_expiry_date" name="edit_expiry_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Service Tag" autocomplete="off">
                        @error('edit_expiry_date')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="text-white justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-pen"></i>&nbsp;UPDATE</button>
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
                "pageLength": 10,
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
                    // {
                    //     data: 'current_users',
                    //     title: 'CURRENT USERS',
                    //     render: function(data, type) {
                    //         return "<span class='font-bold text-gray-700 '> " + data +
                    //             "</span>"
                    //     }
                    // },
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
                    "targets": [],
                    "orderable": false
                }]
            });

            $('#create_drawer_btn').click(function(e) {
                $("#drawer_create").removeClass('hidden');
            });

            $('#softwares_tbl').on('click', 'tbody tr', function() {

                const targetEl = document.getElementById('drawer_edit');
                const options = {
                    placement: 'right',
                    backdrop: true,
                    bodyScrolling: false,
                    edge: false,
                    edgeOffset: '',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',

                };
                const drawer = new Drawer(targetEl, options);
                drawer.toggle();
                $("#drawer_edit").removeClass('hidden');
                $.ajax({
                    url: "{{ route('software.edit', '') }}" + "/" + softwares_tbl.row(this).data()
                        .id,
                    type: "GET",
                    success: function(response) {

                        $("#edit_id").val(response.id);

                        $("#edit_name").val(response.name);
                        $("#edit_FA_control_no").val(response.FA_control_no);
                        $("#edit_stocks").val(response.stocks);
                        $("#edit_supplier").val(response.supplier);
                        $("#edit_contract_no").val(response.contract_no);
                        $("#edit_remarks").val(response.remarks);
                        $("#edit_expiry_date").val(response.expiry_date);


                    }
                });
            });


        });
    </script>
@endsection
