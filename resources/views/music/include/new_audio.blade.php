@foreach ($audios as $audio)
    <li>
        <p><span id="{{asset($audio->audio_url)}}">{{$audio->name}}</span>
            <select name="playlist_id" id="playlist_id" data-music="{{$audio->id}}">
                <option value="" selected
                ></option>
                @foreach($playlist_user as $item)
                    <option value="{{$item->id}}"
                    >{{$item->name}}</option>
                @endforeach
            </select>
        </p>
    </li>
@endforeach