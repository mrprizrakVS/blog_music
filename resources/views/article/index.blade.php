@extends('layouts.app')

@section('content')
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <div class="text-center">
            <a href="{{route('article.create')}}">
                <button class="btn btn-primary">Створити</button>
            </a><br/>
            <br/>
            </div>
        @endif
        <div class="container up-footer">
            @foreach($articles as $article)
                    <div class="anons">
                        <div class="row">

                            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 center">
                                <a href="{{route('article.show', $article->id)}}"> {!! !empty($article->img_url) ? '<img src="'. asset($article->img_url) .'" alt="'.$article->title.'" style="width:250px; height: 250px; ">' : null !!}</a></div>

                            <div class=" col-lg-9 col-md-8 col-sm-12 col-xs-12"><a href="{{route('article.show', $article->id)}}"><h3>{{$article->title}}</h3></a><p>{{$article->description}}</p>
                            </div>
                        </div>
                    </div>

            @endforeach
            {{$articles->links()}}
        </div>
@endsection