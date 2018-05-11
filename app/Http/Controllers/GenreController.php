<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genre.show', compact('genre'));
    }

    public function create()
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            return view('genre.create');
        } else {
            return redirect(route('music.index'));
        }
    }

    public function store(GenreRequest $request)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            Genre::create($request->all());
            return redirect(route('genre.index'));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function edit($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $genre = Genre::findOrFail($id);
            return view('genre.edit', compact('genre'));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function update(GenreRequest $request, $id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            Genre::findOrFail($id)->update($request->all());
            return redirect(route('genre.index', $id));
        } else {
            return redirect(route('music.index'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            Genre::destroy($id);
        } else {
            return redirect(route('music.index'));
        }
    }
}
