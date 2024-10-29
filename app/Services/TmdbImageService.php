<?php

namespace App\Services;

use App\Enum\TmdbImageSizeEnum;
use Illuminate\Support\Facades\Http;

class TmdbImageService
{
    public function __construct(
        private readonly string $filePath,
        private readonly TmdbImageSizeEnum $imageSizeEnum,
        private readonly string $fallbackName,
    )
    {
    }

    public function getImageUrl(): string
    {
        $url = $this->makeImageUrl();

        if ($this->isImageAvailableOnTmdb($url))
        {
            return $url;
        }

        return $this->getDefaultImageFromAvatarUi($this->fallbackName);
    }

    private function isImageAvailableOnTmdb(string $url): bool
    {
        return Http::get($url)->getStatusCode() === 200;
    }

    private function makeImageUrl(): string
    {
        return config('services.tmdb.image_api_url')
            . '/' . $this->imageSizeEnum->value
            . '/' . $this->filePath;
    }

    public function getDefaultImageFromAvatarUi(string $name)
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($name);
    }
}