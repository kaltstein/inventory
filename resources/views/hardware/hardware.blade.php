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


            <table id="hardwares_tbl"
                class=" hover  w-full text-sm hover:cursor-pointer compact   text-gray-500 shadow-md row-border no-wrap"
                width="100%">
                <thead class="text-white bg-gray-700"></thead>
            </table>

        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('.hardware-nav').addClass('text-blue-500');
            var hardwares_tbl = $('#hardwares_tbl').DataTable({

                // scrollX: true,
                // scrollY: true,
                ajax: "{{ route('hardware.list') }}",
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
                        data: 'asset_no',
                        title: 'ASSET#',
                        render: function(data, type) {
                            return "<span class='font-bold text-blue-700 '> " + data +
                                "</span>"
                        }
                    },
                    {
                        data: 'current_user.name',
                        title: 'CURRENT USER',
                        render: function(data, type) {
                            return "<span class='font-bold text-gray-700 '> " + data +
                                "</span>"
                        }

                    },
                    {
                        data: 'current_user.team.name',
                        title: 'TEAM',
                    },
                    {
                        data: 'current_user.department.name',
                        title: 'DEPARTMENT',
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
                        data: 'brand',
                        title: 'BRAND'
                    },
                    {
                        data: 'specs',
                        title: 'SPECS',
                    },
                    {
                        data: 'supplier',
                        title: 'SUPPLIER',
                    },
                    {
                        data: 'serial_no',
                        title: 'SERIAL#',
                        className: 'dt-right'
                    },
                    {
                        data: 'service_tag',
                        title: 'SERVICE TAG',
                        className: 'dt-right'
                    },
                    {
                        data: 'FA_control_no',
                        title: 'FA CONTROL#',
                        className: 'dt-right'
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
