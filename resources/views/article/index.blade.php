@extends('layouts.app')

@section('content')
    <div class="text-center">
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <a href="{{route('article.create')}}">
                <button class="btn btn-primary">Create</button>
            </a><br/>
            <br/>
        @endif
        <div class="list-group">
            @foreach($articles as $article)
                <div class="list-group-item">
                    <a href="{{route('article.show', $article->id)}}">{{$article->title}} </a> (
                    <small>{{$article->created_at->format('d-m-Y')}}</small>
                    )<br/>
                    <p>
                        {{$article->description}}
                    </p>
                    {!! !empty($article->img_url) ? '<img src="'. asset($article->img_url) .'" alt="'.$article->title.'" style="width:250px; height: 250px; ">' : null !!}
                    <br/>
                </div>
                <br/>
            @endforeach
        </div>
    </div>
@endsection