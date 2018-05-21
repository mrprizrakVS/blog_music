@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <form method="POST" class="form-signin" action="{{ route('register') }}">
            @csrf


            <h2 class="form-signin-heading center">Реєстрація</h2>


            <input type="text" class="form-control" name="name" placeholder="Введіть Ваше Ім'я" required=""
                   autofocus=""/>
            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                   placeholder="Введіть Email" required="" autofocus=""/>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" placeholder="Введіть пароль" required=""/>

            @if ($errors->has('password'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password_confirmation" placeholder="Введіть пароль повторно" required=""/>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
