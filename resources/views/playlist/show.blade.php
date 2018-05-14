@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
        span.playing active {
            color: red;
            text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.3);
        }
    </style>
    <script>
        $(document).ready(function () {
            function load_audio(page) {
                var _page = page;
                $.ajax({
                    url: "/playlist/load-audio/{{$playlists->id}}/" + _page,
                    success: function (html) {
                        $("#playlist").append(html);
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
                    audio.play();
                    k = 0;
                }, true);


            });
            var inProgress = false;
            var pagee = 1;
            var countaudio = "{{$playlists->music->count()}}";
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



        });
    </script>
    <div class="text-center">
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
        <br/>
        <br/>
        <div id="name" style="background-color: #9E9E9E; width: 100%;"></div>
        <audio id="audio" src="" controls
               style=" width: 100%; background-color: #ccc; border-top: 1px solid #009be3;"></audio>
        <div class="jp-playlist" style="font-size: 14px;">
            <ul>
                <div id="playlist">
                    @foreach($playlists->music()->paginate(10) as $playlist)
                        <li><p><span id="{{asset($playlist->audio_url)}}">{{$playlist->name}}</span>
                            <form method="get" action="/channels/show/8">
                                <select name="cat_id" onChange="window.location='/channels/show/{{$playlist->id}}/status/'+this.value;">
                                    @foreach($playlist_user as $item)
                                        <option value="{{$item->id}}" selected
                                                ></option>
                                        <option value="{{$item->id}}"
                                                >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </form>
                            </p>
                        </li>

                    @endforeach
                </div>
            </ul>
        </div>

        <small>Date: {{$playlists->created_at->format('d-m-Y')}}</small>
    </div>
@endsection