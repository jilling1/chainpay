@extends('layouts.general_layout')

@section('page')
    <div class="full-page-container">
        <div class="d-flex flex-row justify-content-center px-4" style="margin-top:9vh">
            <div class="card" style="width:28rem;">
                <div class="card-header py-3  d-flex justify-content-between align-items-center"
                     style="border-bottom: 1px solid #eee;">
                    <h5>Signup. It's Free!</h5>
                    <div class="media-box media-box-sm bg-primary text-white" style="">
                        <i class="material-icons">all_inclusive</i>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-4 mt-2">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   value="{{ old('name') }}" placeholder="Use A-Z, 0-9, _" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group mb-4 mt-2">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ old('email') }}" placeholder="abc@geekman.site" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group mb-4 mt-2">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" placeholder="******" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group mb-4 mt-2">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" placeholder="******" required>
                        </div>
                        <div class="form-check mb-2 py-2">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">I agree to all <a class="text-info">Terms and Conditions</a></span>
                            </label>
                        </div>
                        <div class="py-1">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('login') }}">
                        <button class=" btn btn-link pl-1">Already have an account? Login Now!</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
