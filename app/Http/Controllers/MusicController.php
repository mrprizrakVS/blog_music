<?php

namespace App\Http\Controllers;

use App\Http\Requests\MusicRequest;
use App\Models\Genre;
use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::orderBy('created_at', 'desc')->paginate(10);
        $genres = Genre::all();
        if (\Auth::check()) {
            $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);
            return view('music.index', compact('musics', 'playlist_user', 'genres'));
        } else {
            return view('music.index', compact('musics', 'genres'));
        }
    }

    public function show($id)
    {
        $music = Music::findOrFail($id);
        return view('music.show', compact('music'));
    }

    public function create()
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $genres = Genre::all();
            return view('music.create', compact('genres'));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function store(Request $request)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $audio_path = '';
            $rules = [
                'name' => 'required|min:3|max:191',
                'audio_url' => 'required|mimetypes:audio/mpeg',
                'genre_id' => 'required',
            ];
            $validation = Validator::make($request->all(), $rules);
            if ($validation->fails()) {
                return redirect(route('music.create'))
                    ->with('message', 'Помилка доданя пісні, заповніть всі поля')
                    ->with('status', 'danger');
            }
//            dd($request->file('audio_url'));
            if ($request->hasfile('audio_url')) {
                $file = $request->file('audio_url');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $audio_path = $file->move('uploads/music/', $filename);
            }

            Music::create([
                'name' => $request->name,
                'audio_url' => $audio_path,
                'user_id' => \Auth::user()->id,
                'genre_id' => $request->genre_id,
            ]);

            return redirect(route('music.index'));

        } else {
            return redirect(route('music.index'));
        }
    }

    public function edit($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $genres = Genre::all();
            $music = Music::findOrFail($id);
            return view('music.edit', compact('music', 'genres'));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function update(MusicRequest $request, $id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $audio_path = '';
            $music = Music::findOrFail($id);
            if ($request->hasfile('audio_url')) {
                if (!empty($music->audio_url)) {
                    $file = $music->audio_url;
                    $filename = public_path() . '/' . $file;
                    \File::delete($filename);
                }
                $file = $request->file('audio_url');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $audio_path = $file->move('uploads/music/', $filename);
            }
            Music::findOrFail($id)->update([
                'name' => $request->name,
                'audio_url' => !empty($audio_path) ? $audio_path : $music->audio_url,
                'user_id' => \Auth::user()->id,
                'genre_id' => $request->genre_id,
            ]);
            return redirect(route('music.index'));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $music = Music::findOrFail($id);
            $music->destroy($id);
            if (!empty($music->audio_url)) {
                $file = $music->audio_url;
                $filename = public_path() . '/' . $file;
                \File::delete($filename);
            }
            return redirect(route('music.index'));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function loadAudio(Request $request)
    {
        $audios = Music::forPage($request->page, 10)->orderBy('created_at', 'desc')->get();
        $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);

        return view('music.include.new_audio', compact('audios', 'playlist_user', 'playlists'));
    }

    public function search(Request $request)
    {
        $musics = Music::where('name', 'LIKE', '%' . $request->search . '%')->get();
        $genres = Genre::all();
        if (\Auth::check()) {
            $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);
            return view('music.search', compact('musics', 'genres', 'playlist_user'));
        } else {
            return view('music.search', compact('musics', 'genres'));
        }

    }
}
