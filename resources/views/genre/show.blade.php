@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('article.edit', $genre->id)}}">
                <button class="btn btn-primary">Edit</button>
            </a>
            <a href="{{route('article.delete', $genre->id)}}">
                <button class="btn btn-danger">Delete</button>
            </a>
        @endif
        <br/>
            <h1>{{$genre->name}}</h1>
            <hr>
        @foreach($genre->music as $music)
                <h3>{{$music->name}}</h3>
                <audio controls {!! !\Auth::check() ? 'controlsList="nodownload"' : null !!}>
                    <source src="{{asset($music->audio_url)}}" >
                    Тег audio не поддерживается вашим браузером.
                </audio>
            <br/>
        @endforeach
    </div>
@endsection