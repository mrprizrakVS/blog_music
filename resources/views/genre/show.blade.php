@extends('layouts.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <div class="container">
        <div class="row">
            <div class=" col-lg-2 col-md-3 col-sm-5 col-xs-12">
                <div class="content">

                    <ul class="nav nav-pills nav-stacked">
                        <h3 class="center mush3">Жанри</h3>
                        @foreach($genres as $genree)
                            <li role="presentation">
                                <a href="{{route('genre.show', $genree->id)}}">
                                    {{$genree->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <div class=" col-lg-10 col-md-9 col-sm-7 col-xs-12">

                @if(\Auth::check() && \Auth::user()->isAdmin == 1 )
                    <a href="{{route('genre.edit', $genre->id)}}">
                        <button class="btn btn-primary">Редагувати</button>
                    </a>
                    <a href="{{route('genre.delete', $genre->id)}}">
                        <button class="btn btn-danger">Видалити</button>
                    </a>
                @endif
                <br/>
                <h1>{{$genre->name}}</h1>
                <hr>
                <div id="name" style="background-color: #9E9E9E; width: 100%;"></div>
                <audio id="audio" src="" controls {!! !\Auth::check() ? 'controlsList="nodownload"' : null !!}
                style=" background-color: #ccc; border-top: 1px solid #009be3;"></audio>
                <div class="jp-playlist" style="font-size: 14px;">
                    <ul class="liborder">
                        <div id="playlist">
                            @foreach($genre->music as $music)
                                <li>
                                    <p><span class="music_list" id="{{asset($music->audio_url)}}">{{$music->name}}</span>
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
                    url: "{{route('genre.load.audio', $genre->id)}}",
                    data: {'page': _page},
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
            var countaudio = "{{$genre->music->count()}}";
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
@endsection