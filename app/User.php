<?php

namespace App;

use App\Models\Article;
use App\Models\Music;
use App\Models\Playlist;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $article
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Music[] $music
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Playlist[] $playlist
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function music()
    {
        return $this->hasMany(Music::class);
    }

    public function playlist()
    {
        return $this->hasMany(Playlist::class);
    }
}
