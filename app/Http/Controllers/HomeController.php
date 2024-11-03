<?php

namespace App\Http\Controllers;

use App\Models\Genre\Storage\MovieGenreCollectionStorage;
use App\Models\Movie\Storage\MovieCollectionStorage;
use App\Services\TmdbApiService;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('home',
        [
            'movies' => MovieCollectionStorage::current(),
            'movieGenres' => MovieGenreCollectionStorage::current(),
        ]);
    }
}