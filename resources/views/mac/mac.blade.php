@extends('layouts.app')

@section('content')
    <style>
        .dataTables_filter {
            margin-bottom: 8px;
        }
    </style>
    <main class="sm:container sm:mx-auto sm:mt-10">
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

            <table id="macs"
                class=" hover  w-full text-xs md:text-sm  hover:cursor-pointer  compact  text-gray-500 shadow-md row-border no-wrap"
                width="100%">
                <thead class="text-white bg-gray-700"></thead>
            </table>

        </div>
    </main>



    <!-- create drawer component -->
    <div id="drawer_create" class="hidden fixed z-40 h-screen p-4 overflow-y-auto bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-right-label">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-6 text-base font-semibold text-gray-500  dark:text-gray-400">
            <i class="fa-solid fa-plus"></i>&nbsp;CREATE
        </h5>
        <form class="mb-6 " method="POST" action="{{ route('mac.create') }}">
            @csrf
            <div class="mb-6">
                <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User
                </label>
                <select type="text" id="user_id" name="user_id"
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
            </div>

            <div class="mb-6">
                <label for="asset_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Asset#
                </label>
                <input type="text" id="asset_no" name="asset_no"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Asset No." autocomplete="off">
                @error('asset_no')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="FA_control_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">FA
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
                <label for="specs" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Specifications
                </label>
                <textarea type="text" id="specs" name="specs"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Specifications" autocomplete="off"></textarea>
                @error('specs')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Branch
                </label>
                <select type="text" id="branch" name="branch"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="BGC">BGC</option>
                    <option value="PAMPANGA">PAMPANGA</option>
                </select>
                @error('branch')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="warranty_check" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warranty
                    Check
                </label>
                <input type="date" id="warranty_check" name="warranty_check"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Warranty Check" autocomplete="off">
                @error('warranty_check')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="warranty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warranty
                </label>
                <input type="text" id="warranty" name="warranty"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Warranty Check" autocomplete="off">
                @error('warranty')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="supplier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Supplier
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
                <label for="system_sn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">System S/N

                </label>
                <input type="text" id="system_sn" name="system_sn"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Service Tag" autocomplete="off">
                @error('system_sn')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="FA_control_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date
                    Released
                </label>
                <input type="date" id="date_released" name="date_released"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Service Tag" autocomplete="off">
                @error('date_released')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Status
                </label>
                <select type="text" id="status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="active">ACTIVE</option>
                    <option value="inactive">INACTIVE</option>
                    <option value="defective">DEFECTIVE</option>
                    <option value="sold">SOLD</option>
                    <option value="for sale">FOR SALE</option>
                    <option value="phased-out">PHASED-OUT</option>
                </select>
                @error('status')
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
        <form class="mb-6 " method="POST" action="{{ route('mac.update') }}">
            @csrf
            <div class="mb-6">
                <input type="hidden" name="edit_id" id="edit_id">
                <label for="edit_user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User
                </label>
                <select type="text" id="edit_user_id" name="edit_user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">None</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('edit_user_id')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="edit_asset_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Asset#
                </label>
                <input type="text" id="edit_asset_no" name="edit_asset_no"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Asset No." autocomplete="off">
                @error('edit_asset_no')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="edit_FA_control_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">FA
                    Control#
                </label>
                <input type="text" id="edit_FA_control_no" name="edit_FA_control_no"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Service Tag" autocomplete="off">
                @error('edit_FA_control_no')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="edit_specs"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Specifications
                </label>
                <textarea type="text" id="edit_specs" name="edit_specs"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Specifications" autocomplete="off"></textarea>
                @error('specs')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="edit_branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Branch
                </label>
                <select type="text" id="edit_branch" name="edit_branch"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="BGC">BGC</option>
                    <option value="PAMPANGA">PAMPANGA</option>
                </select>
                @error('edit_branch')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="edit_warranty_check"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warranty
                    Check
                </label>
                <input type="date" id="edit_warranty_check" name="edit_warranty_check"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Warranty Check" autocomplete="off">
                @error('edit_warranty_check')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="edit_warranty"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Warranty
                </label>
                <input type="text" id="edit_warranty" name="edit_warranty"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Warranty Check" autocomplete="off">
                @error('edit_warranty')
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
                <label for="edit_system_sn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">System
                    S/N

                </label>
                <input type="text" id="edit_system_sn" name="edit_system_sn"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Service Tag" autocomplete="off">
                @error('edit_system_sn')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="edit_date_released"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date
                    Released
                </label>
                <input type="date" id="edit_date_released" name="edit_date_released"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Service Tag" autocomplete="off">
                @error('edit_date_released')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="edit_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Status
                </label>
                <select type="text" id="edit_status" name="edit_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="active">ACTIVE</option>
                    <option value="inactive">INACTIVE</option>
                    <option value="defective">DEFECTIVE</option>
                    <option value="sold">SOLD</option>
                    <option value="for sale">FOR SALE</option>
                    <option value="phased-out">PHASED-OUT</option>
                </select>
                @error('edit_status')
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

    <script>
        $(document).ready(function() {
            $('.mac-nav').addClass('text-blue-500');
            var macs = $('#macs').DataTable({

                scrollX: true,
                scrollY: true,
                ajax: "{{ route('mac.list') }}",
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
                        data: 'asset_no',
                        title: 'ASSET#',

                    },
                    {
                        data: 'current_user.name',
                        title: 'CURRENT USER',
                        render: function(data, type) {
                            if (data) {
                                return "<span class='font-bold text-gray-700 '> " + data +
                                    "</span>";
                            } else {
                                return "<span class='text-green-700 font-bold'>Unassigned</span>";
                            }
                        }
                    },
                    {
                        data: 'current_user.team.name',
                        title: 'TEAM',
                        render: function(data, type) {
                            if (data) {
                                return "<span class='font-bold text-gray-700 '> " + data +
                                    "</span>";
                            } else {
                                return "--";
                            }
                        }
                    },
                    {
                        data: 'current_user.department.name',
                        title: 'DEPARTMENT',
                        render: function(data, type) {
                            if (data) {
                                return "<span class='font-bold text-gray-700 '> " + data +
                                    "</span>";
                            } else {
                                return "--";
                            }
                        }
                    },
                    {
                        data: 'FA_control_no',
                        title: 'FA CONTROL#',
                    },
                    {
                        data: 'specs',
                        title: 'SPECS',
                    },
                    {
                        data: 'branch',
                        title: 'BRANCH'
                    },
                    {
                        data: 'warranty_check',
                        title: 'WARRANTY CHECK',
                        className: 'dt-right',
                        render: function(data, type) {

                            if (data != null) {
                                return moment(data).format('MMM DD, YYYY');
                            } else {
                                return "";
                            }

                        }
                    },
                    {
                        data: 'warranty',
                        title: 'WARRANTY',
                    },
                    {
                        data: 'supplier',
                        title: 'SUPPLIER',
                    },

                    {
                        data: 'system_sn',
                        title: 'SYSTEM S/N',
                    },


                    {
                        data: 'date_released',
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
                        data: 'status',
                        title: 'STATUS',
                        render: function(data, type) {

                            if (data == 'active') {
                                return "<span class='text-green-700 capitalize font-bold'>• " +
                                    data +
                                    "</span>"
                            } else if (data == 'sold') {
                                return "<span class='text-yellow-700 capitalize font-bold'>• " +
                                    data +
                                    "</span>"
                            } else if (data == 'for sale') {
                                return "<span class='text-orange-700 capitalize font-bold'>• " +
                                    data +
                                    "</span>"
                            } else {
                                return "<span class='text-red-700 capitalize font-bold'>• " + data +
                                    "</span>"
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
            $('#macs').on('click', 'tbody tr', function() {



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
                    url: "{{ route('mac.edit', '') }}" + "/" + macs.row(this).data()
                        .id,
                    type: "GET",
                    success: function(response) {

                        $("#edit_id").val(response.id);
                        $("#edit_user_id").val(response.user_id);
                        $("#edit_asset_no").val(response.asset_no);
                        $("#edit_FA_control_no").val(response.FA_control_no);
                        $("#edit_specs").val(response.specs);
                        $("#edit_branch").val(response.branch);

                        $("#edit_warranty_check").val(response.warranty_check);

                        $("#edit_warranty").val(response.warranty);
                        $("#edit_supplier").val(response.supplier);
                        $("#edit_system_sn").val(response.system_sn);

                        $("#edit_date_released").val(response.date_released);
                        $("#edit_status").val(response.status);
                    }
                });
            });

        });
    </script>
@endsection
