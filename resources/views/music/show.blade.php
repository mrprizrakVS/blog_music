@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('music.edit', $music->id)}}">
                <button class="btn btn-primary">Edit</button>
            </a>
            <a href="{{route('music.delete', $music->id)}}">
                <button class="btn btn-danger">Delete</button>
            </a>
        @endif
        <br/>
        <h2>{{$music->name}}</h2>
        <small>author: {{$music->user->name}}</small>
            <br/>
            <small>genre: <a href="{{route('genre.show', $music->genre->id)}}">{{$music->genre->name}}</a></small>
            <br/>


                <audio controls {!! !\Auth::check() ? 'controlsList="nodownload"' : null !!}>
                    <source src="{{asset($music->audio_url)}}" >
                    Тег audio не поддерживается вашим браузером.
                </audio>

            <br/>
        <small>Date: {{$music->created_at->format('d-m-Y')}}</small>
    </div>
@endsection