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
                            <th>Seller Name</th>
                            <th>Payment Address</th>
                            <th>Amount</th>
                            <th>Amount (USD)</th>
                            <th>Date</th>
                            <th>Status</th>
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
                "order": [[ 6, "desc" ]],
                "ajax": "{{route('all-payments-query')}}",
                "processing":true,
                "serverSide":true,
                // "searching": false,
                // "sort": false,
                "columns": [
                    {name: 'seller_token', data: 'user.seller_token'},
                    {name: 'seller_name', data: 'user.seller_name'},
                    {name: 'payment_forwarding_address', data: 'payment_forwarding_address'},
                    {name: 'full_amount', data: 'full_amount'},
                    {name: 'full_amount_usd', data: 'full_amount_usd'},
                    {name: 'created_at', data: 'created_at'},
                    {name: 'status', data: 'status'}
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

