@extends('layouts.app_layout')
@section('title', 'Payments')
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
                                <th>Payment address</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payed</th>
                                <th>Payment token</th>
                                <th>Callback URL</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            $('#payments-table').DataTable({
                "order": [[ 6, "desc" ]],
                "ajax": "{{route('payments-query')}}",
                "processing":true,
                "serverSide":true,
                "columns": [
                    {name: 'payment_forwarding_address', data: 'payment_forwarding_address', searchable: true, className: 'copy-to-clipboard'},
                    {name: 'full_amount', data: 'full_amount', searchable: false, className: 'copy-to-clipboard'},
                    {name: 'status', data: 'status', searchable: false},
                    {name: 'payed', data: 'payed', searchable: false, className: 'copy-to-clipboard'},
                    {name: 'payment_token', data: 'payment_token', searchable: true, className: 'copy-to-clipboard'},
                    {name: 'callback_url', data: 'callback_url', searchable: false, className: 'copy-to-clipboard'},
                    {name: 'created_at', data: 'created_at', searchable: false, className: 'copy-to-clipboard'}
                ]
            });
        } );
    </script>
    <style>
        .dataTable td{
            clear: both;
            margin-bottom: 6px !important;
            max-width: none !important;
            table-layout: fixed;
            word-break: break-all;
        }
    </style>
@endsection

