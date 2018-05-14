@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check())
            <a href="{{route('playlist.edit', $playlists->id)}}">
                <button class="btn btn-primary">Edit</button>
            </a>
            <a href="{{route('playlist.delete', $playlists->id)}}">
                <button class="btn btn-danger">Delete</button>
            </a>
        @endif
        <br/>
        <h2>{{$playlists->name}}</h2>
        <small>author: {{$playlists->user->name}}</small>
        <br/>
        <br/>
        @foreach($playlists->music as $playlist)
            <h5>{{$playlist->name}}</h5><br/>
            <audio controls {!! !\Auth::check() ? 'controlsList="nodownload"' : null !!}>
                <source src="{{asset($playlist->audio_url)}}">
                Тег audio не поддерживается вашим браузером.
            </audio>
            <br/>
        @endforeach
        <small>Date: {{$playlists->created_at->format('d-m-Y')}}</small>
    </div>
@endsection