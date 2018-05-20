@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        span.playing active {
            color: red;
            text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.3);
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <div class=" col-lg-2 col-md-3 col-sm-5 col-xs-12">
                <div class="content">

                    <ul class="nav nav-pills nav-stacked">
                        <h3 class="center mush3">Жанри</h3>
                        @foreach($genres as $genre)
                            <li role="presentation">
                                <a href="{{route('genre.show', $genre->id)}}">
                                    {{$genre->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12 text-center">

                @if(\Auth::check())
                    <a href="{{route('playlist.edit', $playlists->id)}}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <a href="{{route('playlist.delete', $playlists->id)}}">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                @endif
                <br/>
                <h2>{{$playlists->name}}</h2>
                <small>author: {{$playlists->user->name}}</small>
                <small>Date: {{$playlists->created_at->format('d-m-Y')}}</small>
                <br/>
                <br/>
                <div id="name" style="background-color: #9E9E9E; width: 100%;"></div>
                <audio id="audio" src="" controls {!! !\Auth::check() ? 'controlsList="nodownload"' : null !!}
                style=" width: 100%; background-color: #ccc; border-top: 1px solid #009be3;"></audio>
                <div class="jp-playlist" style="font-size: 14px;">
                    <ul>
                        <div id="playlist">
                            @foreach($playlists->music()->paginate(10) as $playlist)
                                <li>
                                    <p><span id="{{asset($playlist->audio_url)}}">{{$playlist->name}}</span>
                                        @if(!auth()->guard()->guest())
                                            @if(\Auth::user()->id != $playlists->user_id)
                                                <select name="playlist_id" id="playlist_id"
                                                        data-music="{{$playlist->id}}">
                                                    <option value="" selected
                                                    ></option>
                                                    @foreach($playlist_user as $item)
                                                        <option value="{{$item->id}}"
                                                        >{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @else
                                            <a href="#" id="delete_music" data-playlist="{{$playlists->id}}"
                                               data-music="{{$playlist->id}}" style="display: inline;">Видалити</a>
                                        @endif
                                    </p>
                                </li>


                            @endforeach

                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            function load_audio(page) {
                var _page = page;
                $.ajax({
                    url: "/playlist/load-audio/{{$playlists->id}}/" + _page,
                    success: function (html) {
                        $("#playlist").append(html);
                    },
                    error: function (jqXHR, ajaxOptions, thrownError) {
                        console.log('error');
                    }
                });
            }

            var track;
            var k = 0;
            $('#playlist').on('mouseover', 'span', function () {
                var audio = document.getElementById("audio");
                var all_span = document.getElementsByTagName("span");

                for (i = 0; i < all_span.length; i++) {
                    all_span[i].onclick = function () {
                        track = this.id;
                        audio.src = this.id;
                        $('#name').html(this.innerHTML);
                        audio.play();
                    }
                }
                audio.addEventListener("play", function () {
                    for (i = 0; i < all_span.length; i++) {
                        if (audio.src == all_span[i].id) {
                            $('#name').html(all_span[i].innerHTML);
                            track = all_span[i].id;
                        }
                    }
                }, true);
                audio.addEventListener("ended", function () {
                    for (i = 0; i < all_span.length; i++) {
                        if (track == all_span[i].id) {
                            k = i + 1;
                        }
                    }
                    audio.src = all_span[k].id;
                    $('#name').html(all_span[k].innerHTML);
                    audio.play();
                    k = 0;
                }, true);


            });
            var inProgress = false;
            var pagee = 2;
            var countaudio = "{{$playlists->music()->count()}}";
//            load_audio(pagee);
            if (countaudio >= 10) {
                $(window).scroll(function () {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height() && !inProgress) {
                        inProgress = true;
                        load_audio(pagee);
                        pagee++;
                    }
                    inProgress = false;
                });
            }

            $(document).on('change', '#playlist_id', function (event) {
                event.preventDefault();
                var playlist_id = $(this).val();
                var music_id = $(this).data("music");
                $.ajax({
                    url: "{{route('playlist.add')}}",
                    data: {
                        'playlist_id': playlist_id,
                        'music_id': music_id
                    },
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{!! csrf_token()!!}"
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (jqXHR, ajaxOptions, thrownError) {
                        alert('Не додано в плейлист!');
                    }
                });
            });
            $(document).on('click', '#delete_music', function (event) {
                event.preventDefault();
                var playlist_id = $(this).data("playlist");
                var music_id = $(this).data("music");
                console.log(playlist_id, music_id);
                $.ajax({
                    url: "{{route('playlist.add')}}",
                    data: {
                        'playlist_id': playlist_id,
                        'music_id': music_id
                    },
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{!! csrf_token()!!}"
                    },
                    success: function (data) {
                        $(this).css("display", "none");
                        alert('Bидалено!');
                        location.reload();
                    },
                    error: function (jqXHR, ajaxOptions, thrownError) {
                        alert('Не видалено!');
                    }
                });
            });
        });
    </script>

@endsection