@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('article.create')}}">
                <button class="btn btn-primary">Create</button>
            </a><br/>
        @endif
        @foreach($articles as $article)
           <a href="{{route('article.show', $article->id)}}">{{$article->title}} </a> (<small>{{$article->created_at->format('d-m-Y')}}</small>)<br/>
        <p>
            {{$article->description}}
        </p>
            {!! !empty($article->img_url) ? '<img src="'. asset($article->img_url) .'" alt="'.$article->title.'" style="width:250px; height: 250px; ">' : null !!}<br/>
        @endforeach
    </div>
@endsection