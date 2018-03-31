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
                                    <td>{{$payment->payment_forwarding_address}}</td>
                                    <td>{{$payment->full_amount}}</td>
                                    <td>{{\App\Models\Payment::$status[$payment->status]}}</td>
                                    <td>{{$payment->payed}}</td>
                                    <td>{{$payment->payment_token}}</td>
                                    <td>{{$payment->callback_url}}</td>
                                    <td>{{$payment->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="clipboard">
    <script>
        $(document).ready( function () {
            $('#payments-table').DataTable();
        } );

        $('#payments-table').on('click', 'td', (evt)=>{
            $('#clipboard').val( evt.target.textContent );
            document.execCommand("copy");
        });

        document.addEventListener("copy", function(evt) {
            evt.preventDefault();
            evt.clipboardData.setData( "text/plain", $('#clipboard').val() );
            let prevTimeout = toastr.options.timeOut;
            toastr.options.timeOut = 30;
            toastr.info('Copied to clipboard');
            toastr.options.timeOut = prevTimeout;
        });
    </script>
@endsection

