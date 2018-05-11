@extends('layouts.app')

@section('content')
    <div class="text-center">
        <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input name="title" class="form-control" value="{{old('title')}}" placeholder="Title"><br/>
            <textarea name="description" class="form-control" placeholder="Description">{{old('description')}}</textarea><br/>
            <textarea name="full_text" class="form-control" placeholder="Full Text">{{old('full_text')}}</textarea><br/>
            <input name="img_url" type="file" class="form-control" placeholder="Image"><br/>
            <button class="btn btn-success">Create</button>
        </form>
    </div>
@endsection