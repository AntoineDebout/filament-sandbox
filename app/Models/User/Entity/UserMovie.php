<?php

namespace App\Models\User\Entity;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserMovie extends Pivot
{
    protected $table = 'user_movie_pivot';
}