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


            <table id="softwares_tbl"
                class=" hover  w-full text-sm hover:cursor-pointer compact   text-gray-500 shadow-md row-border no-wrap"
                width="100%">
                <thead class="text-white bg-gray-700"></thead>
            </table>

        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.software-nav').addClass('text-blue-500');
            var softwares_tbl = $('#softwares_tbl').DataTable({

                // scrollX: true,
                // scrollY: true,
                ajax: "{{ route('software.list') }}",
                // colReorder: true,

                processing: true,
                serverSide: true,

                "lengthChange": false,
                "pageLength": 15,
                columns: [{
                        data: 'id',
                        title: 'ID',
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
                        data: 'FA_control_no',
                        title: 'FA CONTROL#',
                        className: 'dt-right'
                    },
                    {
                        data: 'stocks',
                        title: 'STOCKS',
                        className: 'dt-right',
                        render: function(data, type) {
                            return "<span class='font-bold text-green-700 '> " + data +
                                "</span>"
                        }
                    },
                    {
                        data: 'supplier',
                        title: 'SUPPLIER',
                    },
                    {
                        data: 'contract_no',
                        title: 'CONTRACT#',
                        className: 'dt-right'
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


        });
    </script>
@endsection
