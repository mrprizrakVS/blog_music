@extends('layouts.app')

@section('content')
    <div class="text-center">
        <form action="{{route('genre.update', $genre->id)}}" method="POST" >
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <input name="name" class="form-control" value="{{old('name', $genre->name)}}" placeholder="Name"><br/>

            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection