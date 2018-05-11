@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('music.create')}}">
                <button class="btn btn-primary">Create</button>
            </a><br/>
        @endif
        @foreach($musics as $music)
           <a href="{{route('music.show', $music->id)}}">{{$music->name}} </a> (<small>{{$music->created_at->format('d-m-Y')}}</small>)<br/>

            {{--{!! !empty($article->img_url) ? '<img src="'. asset($article->img_url) .'" alt="'.$article->title.'" style="width:250px; height: 250px; ">' : null !!}<br/>--}}
        @endforeach
    </div>
@endsection