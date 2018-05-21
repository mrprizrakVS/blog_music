@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <form method="POST" class="form-signin" action="{{ route('login') }}">
            @csrf


            <h2 class="form-signin-heading center">Увійти</h2>
            <input type="text" class="form-control" name="email" placeholder="{{ __('E-Mail Address') }}" required="" autofocus="" />
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
            <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required=""/>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>

                    <button type="submit" class="btn btn-lg btn-primary btn-block">
                        Увійти
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
        </form>
    </div>

@endsection
