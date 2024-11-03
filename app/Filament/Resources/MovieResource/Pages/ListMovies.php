<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use App\Filament\Resources\MovieResource\Widgets\MoviesOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMovies extends ListRecords
{
    protected static string $resource = MovieResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            MoviesOverview::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
