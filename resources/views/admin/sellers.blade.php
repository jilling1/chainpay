@extends('layouts.app_layout')
@section('title', 'Sellers List')
@section('content')
    <div class="row" style="overflow: auto;">
        <div class="col-md-12" style="width: auto">
            <div class="card">
                <div class="card-header">
                    <b>Payments</b>
                </div>
                <div class="card-body">
                    <table id="sellers-table">
                        <thead>
                        <tr>
                            <th>Seller Token</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Company Name</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            let table = $('#sellers-table');
            table.DataTable({
                // "order": [[ 6, "desc" ]],
                "ajax": "{{route('sellers-query')}}",
                "processing":true,
                "serverSide":true,
                "searching": false,
                "sort": false,
                "columns": [
                    {name: 'seller_token', data: 'seller_token', sortable: false},
                    {name: 'first_name', data: 'first_name', sortable: false},
                    {name: 'last_name', data: 'last_name', sortable: false},
                    {name: 'email', data: 'email', sortable: false},
                    {name: 'company_name', data: 'company_name', sortable: false}
                ]
            });

            function rebindCopy() {
                    //Влад, удачи тебе. 11 мая 2018
                let elements = table.find('tbody td');
                elements.unbind('click');
                elements.on('click', (evt)=>{
                    Clipboard.copy(evt.currentTarget.textContent.trim());
                    toastr.info('Copied to clipboard');
                });
            }
            table.on( 'draw.dt', function () { rebindCopy() } );
        } );
    </script>
    <style>
        .dataTable td {
            clear: both;
            margin-bottom: 6px !important;
            max-width: none !important;
            table-layout: fixed;
            word-break: break-all;
        }
    </style>
@endsection

