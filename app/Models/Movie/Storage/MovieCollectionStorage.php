<?php

namespace App\Models\Movie\Storage;

use App\Models\Base\Storage\BaseStorageTrait;
use App\Services\TmdbApiService;

class MovieCollectionStorage
{
    use BaseStorageTrait;

    public const SINGLE_STORAGE_KEY = 'movie_collection';

    public static function refresh()
    {
        $tmdbApiService = new TmdbApiService();

        $movies = $tmdbApiService->getPopularMovies();

        self::put($movies);
    }
}