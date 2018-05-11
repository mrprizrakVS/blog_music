<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function create()
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            return view('article.create');
        } else {
            return redirect(route('article.index'));
        }
    }

    public function store(ArticleRequest $request)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $image_path = '';
            if ($request->hasfile('img_url')) {
                $file = $request->file('img_url');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $image_path = $file->move('uploads/images/', $filename);
            }

            Article::create([
                'title' => $request->title,
                'img_url' => !empty($image_path) ? $image_path : null,
                'user_id' => \Auth::user()->id,
                'description' => $request->description,
                'full_text' => $request->full_text,
            ]);
            return redirect(route('article.index'));
        } else {
            return redirect(route('article.index'));
        }
    }

    public function edit($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $article = Article::findOrFail($id);
            return view('article.edit', compact('article'));
        } else {
            return redirect(route('article.index'));
        }
    }

    public function update(ArticleRequest $request, $id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $image_path = '';
            $article = Article::findOrFail($id);
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
            Article::findOrFail($id)->update([
                'title' => $request->title,
                'img_url' => !empty($image_path) ? $image_path : $article->img_url,
                'user_id' => \Auth::user()->id,
                'description' => $request->description,
                'full_text' => $request->full_text,
            ]);
            return redirect(route('article.index'));
        } else {
            return redirect(route('article.index'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::check() && \Auth::user()->isAdmin == 1) {
            $article = Article::findOrFail($id);
            $article->destroy($id);
            if (!empty($article->img_url)) {
                $file = $article->img_url;
                $filename = public_path() . '/' . $file;
                \File::delete($filename);
            }
            return redirect(route('article.index'));
        } else {
            return redirect(route('article.index'));
        }
    }
}
