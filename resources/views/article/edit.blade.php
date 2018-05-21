@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        <form action="{{route('article.update', $article->id)}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <input name="title" class="form-control" value="{{old('title', $article->title)}}" placeholder="Title"><br/>
            <textarea name="description" class="form-control" placeholder="Description">{{old('description', $article->description)}}</textarea><br/>
            <textarea name="full_text" class="form-control" placeholder="Full Text">{{old('full_text', $article->full_text)}}</textarea><br/>
            <input name="img_url" type="file" class="form-control" value="{{old('full_text', $article->img_url)}}" placeholder="Image"><br/>
            <button class="btn btn-success">Редагувати</button>
        </form>
    </div>
@endsection