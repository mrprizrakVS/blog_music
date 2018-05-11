<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Genre
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Music[] $music
 * @mixin \Eloquent
 */
class Genre extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function music()
    {
        return $this->hasMany(Music::class);
    }
}
