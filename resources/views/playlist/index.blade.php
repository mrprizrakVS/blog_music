@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" col-lg-2 col-md-3 col-sm-5 col-xs-12">
                <div class="content">

                    <ul class="nav nav-pills nav-stacked">
                        <h3 class="center mush3">Жанри</h3>
                        @foreach($genres as $genre)
                            <li role="presentation">
                                <a href="{{route('genre.show', $genre->id)}}">
                                    {{$genre->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
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
        </div>
    </div>
@endsection