@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        <form action="{{route('genre.update', $genre->id)}}" method="POST" >
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <input name="name" class="form-control" value="{{old('name', $genre->name)}}" placeholder="Name"><br/>

            <button class="btn btn-success">Редагувати</button>
        </form>
    </div>
@endsection