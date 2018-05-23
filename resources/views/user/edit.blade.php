@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('status') }} status-box">
                <button type="button" class="close" data-dismiss="alert"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{route('user.update', $user->id)}}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <input name="email" class="form-control" value="{{old('email', $user->email)}}" placeholder="E-mail"><br/>
            <input name="name" class="form-control" value="{{old('name', $user->name)}}" placeholder="Name"><br/>
            <small style="color:red;">Якщо не потрібно змінювати пароль, залишити пустим</small>
            <input id="current_password" type="password" class="form-control" name="current_password" placeholder="Старий пароль" required><br/>
            <input type="password" class="form-control"
                   name="new_password" placeholder="Введіть пароль" required/><br/>

            <input type="password" class="form-control"
                   name="new_password_confirmation" placeholder="Введіть пароль повторно" required/><br/>
            <button class="btn btn-success">Редагувати</button>
        </form>
    </div>
@endsection