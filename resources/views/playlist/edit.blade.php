@extends('layouts.app')

@section('content')
    <div class="text-center">
        <form action="{{route('music.update', $music->id)}}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <input name="name" class="form-control" value="{{old('name', $music->name)}}" placeholder="Title"><br/>
            <select name="genre_id">
                @foreach($genres as $genre)
                    <option value="{{$genre->id}}"  {!! ($music->genre_id == $genre->id ? 'selected' : '') !!}>{{$genre->name}}</option>
                @endforeach
            </select>
            <input name="audio_url" type="file" class="form-control"  placeholder="Image"><br/>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection