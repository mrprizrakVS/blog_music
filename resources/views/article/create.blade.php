@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        @if(Session::has('message'))
            <div class="alert alert-{{ Session::get('status') }} status-box">
                <button type="button" class="close" data-dismiss="alert"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input name="title" class="form-control" value="{{old('title')}}" placeholder="Title"><br/>
            <textarea name="description" class="form-control" placeholder="Description">{{old('description')}}</textarea><br/>
            <textarea name="full_text" class="form-control" placeholder="Full Text">{{old('full_text')}}</textarea><br/>
            <input name="img_url" type="file" class="form-control" placeholder="Image"><br/>
            <button class="btn btn-success">Створити</button>
        </form>
    </div>
@endsection