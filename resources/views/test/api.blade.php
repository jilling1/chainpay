@extends('layouts.app_layout')
@section('title', 'Testing API')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Create payment</b>
                </div>
                <div class="card-body">
                    <form action="{{route('payment-create')}}" method="post">
                        <div class="form-group">
                            <label for="amount">Amount <span class="text-secondary">(in satoshi)</span></label>
                            <input class="form-control" id="amount" name="amount" type="number"
                                value="1000">
                        </div>
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select class="form-control" name="currency" id="currency">
                                <option selected value="btc">btc</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="seller_token">Seller token</label>
                            <input class="form-control" id="seller_token" name="seller_token" type="text"
                                value="{{\Auth::user()->seller_token}}">
                        </div>
                        <div class="form-group">
                            <label for="callback_url">Callback URL</label>
                            <input class="form-control" id="callback_url" name="callback_url" type="text"
                                value="http://hahaha.hehehe">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button class="btn btn-success" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Create payment</b>
                </div>
                <div class="card-body">
                    <form action="/api/payment-status" method="get">
                        <div class="form-group">
                            <label for="payment_token">Payments Status</label>
                            <input class="form-control" id="payment_token" name="payment_token" type="text">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button class="btn btn-success" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <b>Some info</b>
                </div>
                <div class="card-body">
                    <p>
                        For make payments in btc test currency you can user the bitcoin testnet
                        <a href="https://testnet.manu.backend.hamburg/faucet" target="_blank">faucet</a>.
                        <br>
                        Keep in mind that after each payment, amount reduce twice(minimal payment something about 0.001 btc)
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

