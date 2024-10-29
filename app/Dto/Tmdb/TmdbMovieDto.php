<?php

namespace App\Dto\Tmdb;

class TmdbMovieDto
{
    public function __construct(
        public int $tmdbId,
        public string $title,
        public string $picture
    )
    {
    }

    public static function fromApiResponse(array $data): self
    {
        return new self(
            tmdbId: $data['id'],
            title: $data['title'],
            picture: $data['picture']
        );
    }
}