<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all()->where('user_id', \Auth::user()->id);
        $genres = Genre::all();
        return view('playlist.index', compact('playlists', 'genres'));
    }

    public function show($id)
    {
        $playlists = Playlist::findOrFail($id);
        $genres = Genre::all();
        $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);
        return view('playlist.show', compact('playlists', 'playlist_user', 'genres'));
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
        $playlists = Playlist::findOrFail($id);
        $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);

        return view('playlist.include.new_audio', compact('audios', 'playlist_user', 'playlists'));
    }

    public function addPlaylist(Request $request)
    {
        $playlist_id = $request->playlist_id;
        $music_id = $request->music_id;

        $playlist = Playlist::findOrFail($playlist_id);

        $playlist->music()->toggle($music_id);

        return 'ok';
    }
}
