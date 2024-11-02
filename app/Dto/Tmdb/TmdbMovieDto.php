<?php

namespace App\Dto\Tmdb;

class TmdbMovieDto
{
    public function __construct(
        public readonly int $tmdbId,
        public readonly string $title,
        public readonly string $picturePath,
        public readonly array $genreIds,
        public readonly string $language,
        public readonly string $originalTitle,
        public readonly string $overview,
        public readonly float $popularity,
        public readonly string $releaseDate,
        public readonly float $voteAverage,
        public readonly int $voteCount,
    )
    {
    }

    public static function fromApiResponse(array $attributes): self
    {
        return new self(
            tmdbId: $attributes['id'],
            title: $attributes['title'],
            picturePath: $attributes['poster_path'],
            genreIds: $attributes['genre_ids'],
            language: $attributes['original_language'],
            originalTitle: $attributes['original_title'],
            overview: $attributes['overview'],
            popularity: $attributes['popularity'],
            releaseDate: $attributes['release_date'],
            voteAverage: $attributes['vote_average'],
            voteCount: $attributes['vote_count']
        );
    }
}