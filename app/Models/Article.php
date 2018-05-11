<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Article extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'img_url',
        'description',
        'full_text'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'title' => 'string',
        'img_url' => 'string',
        'description' => 'string',
        'full_text' => 'string'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
