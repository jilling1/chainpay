@extends('layouts.app_layout')
@section('title', 'Account settings')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Seller details</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-seller-details')}}" data-title="Seller details"
                      method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="first_name">First Name*</label>
                                <input class="form-control" id="first_name" name="first_name" type="text"
                                       placeholder="John" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="last_name">Last Name*</label>
                                <input class="form-control" id="last_name" name="last_name" type="text"
                                       placeholder="Smith">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="company_name">Company name*</label>
                                <input class="form-control" id="company_name" name="company_name" type="company_name"
                                       placeholder="Alphabet" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Phone number</label>
                                <input class="form-control" id="phone_number" name="phone_number" type="tel"
                                       placeholder="123456789" required>
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

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Email</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-email')}}" data-title="Email"
                      method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <p>
                                Current <b>{{\Auth::user()->email}}</b>
                            </p>
                            <div class="form-group">
                                <label for="email">New email*</label>
                                <input class="form-control" id="email" name="email" type="email"
                                       placeholder="abc@geekman.site" required>
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
            <div class="card">
                <div class="card-header">
                    <b>Change password</b>
                </div>
                <form class="ajax_form_save" action="{{route('save-password')}}" data-title="Seller details"
                      method="post">
                    {{csrf_field()}}
                    <div class="card-body row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="old_password">Old password*</label>
                                <input class="form-control" id="old_password" name="old_password" type="password"
                                       placeholder="******">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="new_password">New password*</label>
                                <input class="form-control" id="new_password" name="new_password" type="password"
                                       placeholder="******">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="new_password_confirmation">New password confirmation*</label>
                                <input class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                                       type="password"
                                       placeholder="******">
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

