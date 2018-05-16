@extends('layouts.app')

@section('content')
    <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">
        <form action="{{route('music.store')}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input name="name" class="form-control" value="{{old('name')}}" placeholder="Name"><br/>
            <select name="genre_id">
                @foreach($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->name}}</option>
                @endforeach
            </select>
            <input name="audio_url" type="file" class="form-control" placeholder="Audio"><br/>
            <button class="btn btn-success">Create</button>
        </form>
    </div>
@endsection