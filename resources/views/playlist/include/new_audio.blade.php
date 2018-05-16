@foreach ($audios as $audio)
    <li>
        <p><span id="{{asset($audio->audio_url)}}">{{$audio->name}}</span>
                @if(\Auth::user()->id != $playlists->user_id)
                    <select name="playlist_id" id="playlist_id" data-music="{{$audio->id}}">
                        <option value="" selected
                        ></option>
                        @foreach($playlist_user as $item)
                            <option value="{{$audio->id}}"
                            >{{$audio->name}}</option>
                        @endforeach
                    </select>
                @else
                    <a href="#" id="delete_music" data-playlist="{{$playlists->id}}" data-music="{{$audio->id}}" style="display: inline;">Видалити</a>
                @endif
        </p>
    </li>
@endforeach