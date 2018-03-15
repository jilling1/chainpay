@extends('layouts.general_layout')

@section('page')

    <div class="full-page-container">
        <div class="d-flex flex-row justify-content-center px-4" style="margin-top:9vh;">
            <div class="card" style="width:28rem;">
                <div class="card-header py-3  d-flex justify-content-between align-items-center"
                     style="border-bottom: 1px solid #eee;">
                    <h5>Login to Continue</h5>
                    <div class="media-box media-box-sm bg-primary text-white" style="">
                        <i class="material-icons">all_inclusive</i>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-4 mt-2">
                            <label for="exampleInputEmail1">Email address</label>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" placeholder="abc@geekman.site" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label for="exampleInputPassword1">Password</label>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" placeholder="******" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-check mb-2 py-2">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember"
                                       {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Keep Me Logged In</span>
                            </label>
                        </div>
                        <div class="py-1">
                            <button type="submit" class="btn btn-primary btn-block ">Submit</button>
                        </div>
                        <div class="py-2 px-0">
                            <p class="mb-0">
                                <a class="btn btn-link pl-1" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('register') }}">
                        <button class=" btn btn-link pl-1">Don't have an account? Signup Now!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
