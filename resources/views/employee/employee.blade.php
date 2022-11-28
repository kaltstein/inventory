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


            <table id="employees_tbl"
                class=" hover w-full text-xs md:text-sm hover:cursor-pointer   text-gray-500 shadow-md row-border no-wrap"
                width="100%">
                <thead class="text-white bg-gray-700"></thead>
            </table>

        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.employee-nav').addClass('text-blue-500');
            var employees_tbl = $('#employees_tbl').DataTable({

                scrollX: true,
                scrollY: true,
                ajax: "{{ route('employee.list') }}",
                // colReorder: true,

                // processing: true,
                // serverSide: true,

                "lengthChange": false,
                "pageLength": 15,
                columns: [{
                        data: 'id',
                        title: 'ID',


                    },
                    {
                        data: 'department.name',
                        title: 'DEPARTMENT',
                    },
                    {
                        data: 'team.name',
                        title: 'TEAM',
                    },
                    {
                        data: 'name',
                        title: 'NAME'


                    },
                    {
                        data: 'email',
                        title: 'GMAIL',
                    },
                    {
                        data: 'corporate_email',
                        title: 'CORPORATE EMAIL',
                    },
                    {
                        data: 'role',
                        title: 'ROLE',
                    },
                    {
                        data: 'hired_at',
                        title: 'HIRED AT',
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

                            if (data == 'Active') {
                                return "<span class = 'text-green-500 capitalize font-bold' >• " +
                                    data + "</span>";
                            } else {
                                return "<span class = 'text-gray-500 capitalize font-bold' >• " +
                                    data + "</span>";
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
