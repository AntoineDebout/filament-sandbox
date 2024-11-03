<?php

namespace App\Filament\Resources\MovieResource\Widgets;

use Carbon\CarbonInterval;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MoviesOverview extends BaseWidget
{
    private $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Films regardés', $this->user->movies()->count()),
            Stat::make('Temps passé devant des films', $this->getMoviesTotalDuration()),
        ];
    }

    private function getMoviesTotalDuration()
    {
        $sumDurationInMinutes = $this->user->movies()->sum('duration');

        $interval = CarbonInterval::minutes($sumDurationInMinutes);

        return $interval->cascade()->forHumans([
            'join' => true,
            'parts' => 3,
        ]);
    }
}
