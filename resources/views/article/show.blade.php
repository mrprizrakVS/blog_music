@extends('layouts.app')

@section('content')
        @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
            <div class="text-center">
            <a href="{{route('article.edit', $article->id)}}">
                <button class="btn btn-primary">Редагувати</button>
            </a>
            <a href="{{route('article.delete', $article->id)}}">
                <button class="btn btn-danger">Видалити</button>
            </a>
            </div>
        @endif
        <br/>

            <h2 class="newsh2">{{$article->title}}</h2>
            <div class="container">
                <div class="row">



                    <div class="newsp">
                        <p>
                                {!! !empty($article->img_url) ? '<img src="'. asset($article->img_url) .'" alt="'.$article->title.'" class="newsimg"><br/>' : null !!}
                            {{$article->full_text}}
                        </p>
                    </div>

                </div>
            </div>


        <small>Date: {{$article->created_at->format('d-m-Y')}}</small>
@endsection