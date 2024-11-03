<?php

namespace App\Models\Movie\Entity;

use App\Models\User\Entity\User;
use App\Models\User\Entity\UserMovie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movie';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_movie_pivot', 'movie_id', 'user_id')
            ->withPivot('seen_at')
            ->using(UserMovie::class)
            ->withTimestamps();
    }
}