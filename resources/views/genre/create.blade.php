@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        <form action="{{route('genre.store')}}" method="POST" >
            {!! csrf_field() !!}
            <input name="name" class="form-control" value="{{old('name')}}" placeholder="Name"><br/>
            <button class="btn btn-success">Create</button>
        </form>
    </div>
@endsection