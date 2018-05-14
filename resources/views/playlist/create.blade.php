@extends('layouts.app')

@section('content')
    <div class="text-center">
        <form action="{{route('playlist.store')}}" method="POST">
            {!! csrf_field() !!}
            <input name="name" class="form-control" value="{{old('name')}}" placeholder="Name"><br/>

            <button class="btn btn-success">Create</button>
        </form>
    </div>
@endsection