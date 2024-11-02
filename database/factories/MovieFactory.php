<?php

namespace Database\Factories;


use App\Enum\TmdbImageSizeEnum;
use App\Services\TmdbImageService;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    public function definition()
    {
        $tmdbImageService = new TmdbImageService(
            filePath: '',
            imageSizeEnum: TmdbImageSizeEnum::ORIGINAL,
            fallbackName: ''
        );

        $posterPath = $tmdbImageService->getDefaultImageFromAvatarUi($title = $this->faker->name);

        return [
            'title' => $title,
            'overview' => $this->faker->realTextBetween(180,210),
            'poster_path' => $posterPath,
            'tmdb_id' => $this->faker->randomNumber(5),
            'release_date' => $this->faker->dateTimeThisCentury,
            'vote_average' => $this->faker->randomDigitNotNull,
            'vote_count' => $this->faker->randomDigitNotNull,
            'duration' => $this->faker->randomFloat(null, 60, 420)
        ];
    }
}