@extends('layouts.app_layout')
@section('title', 'Account settings')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Account settings</h3>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <b>Seller details</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-seller-details')}}" data-title="Seller details" method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                       placeholder="John" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                       placeholder="John">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="email"
                                       placeholder="abc@geekman.site"
                                       value="{{\Auth::user()->email}}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">Company name</label>
                                <input class="form-control" id="company_name" name="company_name" type="company_name"
                                       placeholder="Alphabet" required>
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

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <b>Wallets addresses</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-wallets_addresses')}}" data-title="Wallets addresses" method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="first_name">BTC</label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                       placeholder="John">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="last_name">DOGE</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                       placeholder="John">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ltc">LTC</label>
                                <input class="form-control" id="ltc" name="ltc" type="text"
                                       placeholder="abc@geekman.site">
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
