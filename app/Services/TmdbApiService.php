<?php

namespace App\Services;

use App\Enum\LanguageEnum;
use Illuminate\Support\Facades\Http;

class TmdbApiService
{
    public function __construct(
        private string $apiKey = '',
        private readonly string $language = LanguageEnum::FRENCH->value,
    )
    {
        $this->apiKey = empty($this->apiKey)  ? config('services.tmdb.api_key') : $this->apiKey;
    }

    public function searchMovies($query)
    {
        $response = Http::get("https://api.themoviedb.org/3/search/movie", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => $this->language,
        ]);

        return $response->successful() ? $response->json()['results'] : [];
    }

    public function searchSeries($query)
    {
        $response = Http::get("https://api.themoviedb.org/3/search/tv", [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => $this->language
        ]);

        return $response->successful() ? $response->json()['results'] : [];
    }

    public function getMovieDetails(int $tmdbId)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$tmdbId}", [
            'api_key' => $this->apiKey,
            'language' => $this->language
        ]);

        return $response->successful() ? $response->json() : null;
    }

    public function getSerieDetails(int $tmdbId)
    {
        $response = Http::get("https://api.themoviedb.org/3/tv/{$tmdbId}", [
            'api_key' => $this->apiKey,
            'language' => $this->language
        ]);

        return $response->successful() ? $response->json() : null;
    }

    public function getMovieImage($id)
    {
        $movie = $this->getMovieById($id);
        return $movie ? "https://image.tmdb.org/t/p/w92" . $movie['poster_path'] : null;
    }

    public function getMovieById(int $id): ?array
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [
            'api_key' => $this->apiKey,
            'language' => $this->language,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function getPopularMovies(){
        $response = Http::get("https://api.themoviedb.org/3/discover/movie", [
            'api_key' => $this->apiKey,
            'language' => $this->language,
            'sort_by' => 'popularity'
        ]);

        if ($response->successful()) {
            return $response->json()['results'];
        }

        return null;
    }

    public function fetchMovieGenres() {
        $response = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
            'api_key' => $this->apiKey,
            'language' => $this->language,
        ]);

        if ($response->successful()) {
            return $response->json()['genres'];
        }
    }
}