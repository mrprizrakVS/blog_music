<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Playlist
 *
 * @property-read \App\Models\Music $music
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Playlist extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'music_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'music_id' => 'integer'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];




    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function music()
    {
        return $this->belongsTo(Music::class, 'music_id');
    }
}
