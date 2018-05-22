@foreach ($audios as $audio)
    <li>
        <p><span class="music_list"  id="{{asset($audio->audio_url)}}">{{$audio->name}}</span>

        </p>
    </li>
@endforeach