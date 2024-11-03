<?php

namespace App\Models\Genre\Storage;

use App\Models\Base\Storage\BaseStorageTrait;
use App\Services\TmdbApiService;

class MovieGenreCollectionStorage
{
    use BaseStorageTrait;

    public const SINGLE_STORAGE_KEY = 'movie_genre_collection';

    public static function refresh()
    {
        $tmdbApiService = new TmdbApiService();

        $genres = $tmdbApiService->fetchMovieGenres();

        self::put($genres);
    }
}