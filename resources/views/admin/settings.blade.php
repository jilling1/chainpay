@extends('layouts.app_layout')
@section('title', 'Settings')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>General Settings</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-general-settings')}}" data-title="General Settings"
                      method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fees_percent">Fee Percent* <span class="text-secondary">(0-99%)</span></label>
                                <div class="input-group">
                                    <input class="form-control" id="fees_percent" name="fees_percent" type="number"
                                           value="{{ env('FEES_PERCENT')||0*100 }}" min="0" max="99" required>
                                    <span class="input-group-addon bg-light">%</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="btc_fees_address">BTC Fees Address*</label>
                                <input class="form-control" id="btc_fees_address" name="btc_fees_address" type="text"
                                       value="{{ env('BTC_FEES_ADDRESS') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="doge_fees_address">DOGE Fees Address</label>
                                <input class="form-control" id="doge_fees_address" name="doge_fees_address" type="text"
                                       value="{{ env('DOGE_FEES_ADDRESS') }}">
                            </div>
                            <div class="form-group">
                                <label for="ltc_fees_address">LTC Fees Address</label>
                                <input class="form-control" id="ltc_fees_address" name="ltc_fees_address" type="text"
                                       value="{{ env('LTC_FEES_ADDRESS') }}">
                            </div>
                            <div class="form-group">
                                <label for="dash_fees_address">DASH Fees Address</label>
                                <input class="form-control" id="dash_fees_address" name="dash_fees_address" type="text"
                                       value="{{ env('DASH_FEES_ADDRESS') }}">
                            </div>
                            <div class="form-group">
                                <label for="payment_await_limit">Payment Await Limit* <span class="text-secondary">(seconds)</span></label>
                                <input class="form-control" id="payment_await_limit" name="payment_await_limit" type="number"
                                       value="{{ env('PAYMENTS_AWAIT_LIMIT_SECONDS') }}" min="1" max="999999" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection

