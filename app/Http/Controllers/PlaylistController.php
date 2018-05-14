<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all();
        return view('playlist.index', compact('playlists'));
    }

    public function show($id)
    {
        $playlists = Playlist::findOrFail($id);
//        dd($playlists->music);
        return view('playlist.show', compact('playlists'));
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
            $image_path = '';
            $article = Playlist::findOrFail($id);
            if ($request->hasfile('img_url')) {
                if (!empty($article->img_url)) {
                    $file = $article->img_url;
                    $filename = public_path() . '/' . $file;
                    \File::delete($filename);
                }
                $file = $request->file('img_url');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $image_path = $file->move('uploads/images/', $filename);
            }
            Playlist::findOrFail($id)->update([
                'title' => $request->title,
                'img_url' => !empty($image_path) ? $image_path : $article->img_url,
                'user_id' => \Auth::user()->id,
                'description' => $request->description,
                'full_text' => $request->full_text,
            ]);
            return redirect(route('playlist.index'));
        } else {
            return redirect(route('playlist.index'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::check()) {
            $article = Playlist::findOrFail($id);
            $article->destroy($id);
            if (!empty($article->img_url)) {
                $file = $article->img_url;
                $filename = public_path() . '/' . $file;
                \File::delete($filename);
            }
            return redirect(route('playlist.index'));
        } else {
            return redirect(route('playlist.index'));
        }
    }
}
