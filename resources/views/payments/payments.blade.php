@extends('layouts.app_layout')
@section('title', 'Payments')
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td class="copy-to-clipboard">{{$payment->payment_forwarding_address}}</td>
                                    <td class="copy-to-clipboard">{{$payment->full_amount}}</td>
                                    <td>{{\App\Models\Payment::$status[$payment->status]}}</td>
                                    <td>{{$payment->payed}}</td>
                                    <td class="copy-to-clipboard">{{$payment->payment_token}}</td>
                                    <td class="copy-to-clipboard">{{$payment->callback_url}}</td>
                                    <td class="copy-to-clipboard">{{$payment->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            $('#payments-table').DataTable({"order": [[ 6, "desc" ]]});
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

