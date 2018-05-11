@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('article.edit', $article->id)}}">
                <button class="btn btn-primary">Edit</button>
            </a>
            <a href="{{route('article.delete', $article->id)}}">
                <button class="btn btn-danger">Delete</button>
            </a>
        @endif
        <br/>
        <h2>{{$article->title}}</h2>
        <small>author: {{$article->user->name}}</small>
        <p>
            {{$article->full_text}}
        </p>

        @if(!empty($article->img_url))
                {!! !empty($article->img_url) ? '<img src="'. asset($article->img_url) .'" alt="'.$article->title.'" style="width:250px; height: 250px; "><br/>' : null !!}
        @endif
        <small>Date: {{$article->created_at->format('d-m-Y')}}</small>
    </div>
@endsection