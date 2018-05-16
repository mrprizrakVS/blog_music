<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'article'], function (){
   Route::get('/', 'ArticleController@index')->name('article.index');
   Route::get('/create', 'ArticleController@create')->name('article.create');
   Route::post('/store', 'ArticleController@store')->name('article.store');
   Route::get('/show/{id}', 'ArticleController@show')->name('article.show');
   Route::get('/edit/{id}', 'ArticleController@edit')->name('article.edit');
   Route::put('/edit/{id}', 'ArticleController@update')->name('article.update');
   Route::get('/delete/{id}', 'ArticleController@destroy')->name('article.delete');
});
Route::group(['prefix'=>'genre'], function (){
   Route::get('/', 'GenreController@index')->name('genre.index');
   Route::get('/create', 'GenreController@create')->name('genre.create');
   Route::post('/store', 'GenreController@store')->name('genre.store');
    Route::get('/show/{id}', 'GenreController@show')->name('genre.show');
   Route::get('/edit/{id}', 'GenreController@edit')->name('genre.edit');
   Route::put('/edit/{id}', 'GenreController@update')->name('genre.update');
   Route::get('/delete/{id}', 'GenreController@destroy')->name('genre.delete');
});
Route::group(['prefix'=>'music'], function (){
   Route::get('/', 'MusicController@index')->name('music.index');
   Route::get('/create', 'MusicController@create')->name('music.create');
   Route::post('/store', 'MusicController@store')->name('music.store');
    Route::get('/show/{id}', 'MusicController@show')->name('music.show');
   Route::get('/edit/{id}', 'MusicController@edit')->name('music.edit');
   Route::put('/edit/{id}', 'MusicController@update')->name('music.update');
   Route::get('/delete/{id}', 'MusicController@destroy')->name('music.delete');
   Route::get('/load-audio', 'MusicController@loadAudio')->name('music.load.audio');
   Route::post('/search', 'MusicController@search')->name('music.search');

});
Route::group(['prefix'=>'playlist'], function (){
   Route::get('/', 'PlaylistController@index')->name('playlist.index');
   Route::get('/create', 'PlaylistController@create')->name('playlist.create');
   Route::post('/store', 'PlaylistController@store')->name('playlist.store');
    Route::get('/show/{id}', 'PlaylistController@show')->name('playlist.show');
   Route::get('/edit/{id}', 'PlaylistController@edit')->name('playlist.edit');
   Route::put('/edit/{id}', 'PlaylistController@update')->name('playlist.update');
   Route::get('/delete/{id}', 'PlaylistController@destroy')->name('playlist.delete');
   Route::get('/load-audio/{id}/{page}', 'PlaylistController@loadAudio')->name('playlist.load.audio');
   Route::post('/playlist-add', 'PlaylistController@addPlaylist')->name('playlist.add');
});