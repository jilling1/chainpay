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
                    <table id="payments-table">
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
            let table = $('#payments-table');
            table.DataTable({
                "order": [[ 6, "desc" ]],
                "ajax": "{{route('all-payments-query')}}",
                "processing":true,
                "serverSide":true,
                // "searching": false,
                // "sort": false,
                "columns": [
                    {name: 'seller_token', data: 'user.seller_token', sortable: false, searchable: true},
                    {name: 'seller_name', data: 'user.seller_name', sortable: false, searchable: true},
                    {name: 'payment_forwarding_address', data: 'payment_forwarding_address', sortable: false, searchable: true},
                    {name: 'full_amount', data: 'full_amount', searchable: false},
                    {name: 'full_amount_usd', data: 'full_amount_usd', sortable: false, searchable: false},
                    {name: 'created_at', data: 'created_at', searchable: false},
                    {name: 'status', data: 'status', searchable: false}
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
            table.on( 'order.dt', function () { rebindCopy(); console.log('11'); } );
            table.on( 'page.dt', function () { rebindCopy(); console.log('22'); } );
            table.on( 'search.dt', function () { rebindCopy(); console.log('33'); } );
            table.on( 'draw.dt', function () { rebindCopy(); console.log('44'); } );
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

