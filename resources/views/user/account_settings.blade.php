@extends('layouts.app_layout')
@section('title', 'Account settings')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Wallets addresses</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-wallets-addresses')}}" data-title="Wallets addresses"
                      method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="btc_address">BTC</label>
                                <input class="form-control" id="btc_address" name="btc_address" type="text"
                                       value="{{\Auth::user()->btc_address}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="doge_address">DOGE</label>
                                <input class="form-control" id="doge_address" name="doge_address" type="text"
                                       value="{{\Auth::user()->doge_address}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ltc_address">LTC</label>
                                <input class="form-control" id="ltc_address" name="ltc_address" type="text"
                                       value="{{\Auth::user()->ltc_address}}">
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
@endsection
