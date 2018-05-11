@extends('layouts.app_layout')
@section('title', 'Sellers List')
@section('content')
    <div class="row">
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
                    {name: 'seller_token', data: 'seller_token'},
                    {name: 'first_name', data: 'first_name'},
                    {name: 'last_name', data: 'last_name'},
                    {name: 'email', data: 'email'},
                    {name: 'company_name', data: 'company_name'}
                ]
            });
            function rebindCopy() {
                let elements = table.find('tbody td');
                elements.unbind('click');
                elements.on('click', (evt)=>{
                    Clipboard.copy(evt.currentTarget.textContent.trim());
                    toastr.info('Copied to clipboard');
                });
            }
            table.on( 'order.dt', function () { rebindCopy() } );
            table.on( 'page.dt', function () { rebindCopy() } );
            table.on( 'search.dt', function () { rebindCopy() } );
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
