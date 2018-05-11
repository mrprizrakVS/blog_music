@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
