<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function show($id)
    {
        $genres = Genre::all();
        $genre = Genre::findOrFail($id);
        if(\Auth::check()) {
            $playlist_user = Playlist::all()->where('user_id', \Auth::user()->id);
            return view('genre.show', compact('genre', 'genres', 'playlist_user'));
        }
        else{
            return view('genre.show', compact('genre', 'genres'));
        }
    }

    public function create()
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            return view('genre.create');
        } else {
            return redirect(route('genre.index'));
        }
    }

    public function store(GenreRequest $request)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            Genre::create($request->all());
            return redirect(route('genre.index'));
        } else {
            return redirect(route('genre.index'));
        }
    }

    public function edit($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $genre = Genre::findOrFail($id);
            return view('genre.edit', compact('genre'));
        } else {
            return redirect(route('genre.index'));
        }
    }

    public function update(GenreRequest $request, $id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            Genre::findOrFail($id)->update($request->all());
            return redirect(route('genre.index', $id));
        } else {
            return redirect(route('genre.index'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            Genre::destroy($id);
        } else {
            return redirect(route('genre.index'));
        }
    }

    public function loadAudio($id, Request $request)
    {
//        $audios = Music::forPage($request->page, 10)->orderBy('created_at', 'desc')->get();
        $audios = Genre::with('music')->findOrFail($id)->music()->forPage($request->page, 10)->get();
//        dd($audios);
        return view('genre.include.new_audio', compact('audios'));
    }
}
