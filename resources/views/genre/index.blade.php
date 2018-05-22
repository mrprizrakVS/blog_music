@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('genre.create')}}">
                <button class="btn btn-primary">Створити</button>
            </a><br/>
        @endif
            <br/>
        @foreach($genres as $genre)
            <div class="list-group">
                <div class="list-group-item">
                    <a href="{{route('genre.show', $genre->id)}}">{{$genre->name}} </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection