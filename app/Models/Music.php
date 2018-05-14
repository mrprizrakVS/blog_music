<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Music
 *
 * @property-read \App\Models\Genre $genre
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Playlist[] $playlist
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Music extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'audio_url',
        'genre_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'audio_url' => 'string',
        'genre_id' => 'integer'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function playlist()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_music','music_id','playlist_id');
    }
}
