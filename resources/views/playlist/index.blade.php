@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check())
            <a href="{{route('playlist.create')}}">
                <button class="btn btn-primary">Create</button>
            </a>
            <br/>
        @endif

            <br/>
        @foreach($playlists as $playlist)
            <div class="list-group">
                <div class="list-group-item">
                    <a href="{{route('playlist.show', $playlist->id)}}">{{$playlist->name}} </a> (
                    <small>{{$playlist->created_at->format('d-m-Y')}}</small>
                    )
                </div>
            </div>

        @endforeach
    </div>
@endsection