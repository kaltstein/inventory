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

            <table id="softwares_tbl"
                class=" hover  w-full text-xs md:text-sm  hover:cursor-pointer compact   text-gray-500 shadow-md row-border no-wrap"
                width="100%">
                <thead class="text-white bg-gray-700"></thead>
            </table>

        </div>
    </main>




    </div>

    <script>
        $(document).ready(function() {
            $('.dashboard-nav').addClass('text-blue-500');

            var softwares_tbl = $('#softwares_tbl').DataTable({

                scrollX: true,
                scrollY: true,
                ajax: "{{ route('dashboard.list') }}",
                // colReorder: true,

                // processing: true,
                // serverSide: true,

                "lengthChange": false,
                "pageLength": 10,
                columns: [

                    {
                        data: 'name',
                        title: 'NAME',
                        render: function(data, type) {
                            return "<span class='font-bold text-gray-700 '> " + data +
                                "</span>"
                        }
                    },
                    {
                        data: 'total_stocks',
                        title: 'STOCKS',
                        className: 'dt-right',
                    },
                    {
                        data: 'total_users',
                        title: 'TOTAL USERS',
                        className: 'dt-right',
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


                ],
                "columnDefs": [{
                    "targets": [1, 2],
                    "orderable": false
                }]
            });


        });
    </script>
@endsection
