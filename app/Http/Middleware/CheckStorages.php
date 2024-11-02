<?php

namespace App\Http\Middleware;

use App\Models\Genre\Storage\MovieGenreCollectionStorage;
use App\Models\Movie\Storage\MovieCollectionStorage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStorages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->checkMovieGenreCollectionStorage();

        $this->checkMovieCollectionStorage();

        return $next($request);
    }

    private function checkMovieCollectionStorage(): void
    {
        if (MovieCollectionStorage::exists() === false)
        {
            MovieCollectionStorage::refresh();
        }
    }

    private function checkMovieGenreCollectionStorage(): void
    {
        if (MovieGenreCollectionStorage::exists() === false)
        {
            MovieGenreCollectionStorage::refresh();
        }
    }
}
