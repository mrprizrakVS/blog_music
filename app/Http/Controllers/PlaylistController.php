<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all()->where('user_id', \Auth::user()->id);
        return view('playlist.index', compact('playlists'));
    }

    public function show($id)
    {
        $playlists = Playlist::findOrFail($id);
        $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);
        return view('playlist.show', compact('playlists', 'playlist_user'));
    }

    public function create()
    {
        if (\Auth::check()) {
            return view('playlist.create');
        } else {
            return redirect(route('playlist.index'));
        }
    }

    public function store(Request $request)
    {
        if (\Auth::check()) {

            Playlist::create([
                'name' => $request->name,
                'user_id' => \Auth::user()->id,
            ]);
            return redirect(route('playlist.index'));
        } else {
            return redirect(route('playlist.index'));
        }
    }

    public function edit($id)
    {
        if (\Auth::check()) {
            $playlist = Playlist::findOrFail($id);
            return view('playlist.edit', compact('playlist'));
        } else {
            return redirect(route('playlist.index'));
        }
    }

    public function update(Request $request, $id)
    {
        if (\Auth::check()) {
            Playlist::findOrFail($id)->update([
                'name' => $request->name,

            ]);
            return redirect(route('playlist.show', $id));
        } else {
            return redirect(route('playlist.index'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::check()) {
            $article = Playlist::findOrFail($id);
            $article->destroy($id);
            return redirect(route('playlist.index'));
        } else {
            return redirect(route('playlist.index'));
        }
    }

    public function loadAudio($id, $page = 1)
    {
        $audios = Playlist::findOrFail($id)->music()->forPage($page, 15)->get();
        foreach ($audios as $audio) {
            echo ' <li><p><span id="' . asset($audio->audio_url) . '">' . $audio->name . '</span>
                                <a href="/people/helper/add_audio.php?komy=1&id_audio=9&act=minus"><i class="glyphicon glyphicon-minus" ></i></a>
                            </p></li>';
        }
    }

    public function addPlaylist($music_id, $playlist)
    {

    }
}
