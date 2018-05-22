@foreach ($audios as $audio)
    <li>
        <p><span class="music_list"  id="{{asset($audio->audio_url)}}">{{$audio->name}}</span>
                <select name="playlist_id" id="playlist_id" data-music="{{$audio->id}}" class="add_playlist">
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