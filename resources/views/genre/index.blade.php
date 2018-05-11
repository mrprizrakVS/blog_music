@extends('layouts.app')

@section('content')

    @foreach($genres as $genre)
        {{$genre->name}} <br/>
    @endforeach
@endsection