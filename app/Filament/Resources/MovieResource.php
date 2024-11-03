<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Models\Movie\Entity\Movie;
use App\Services\TmdbApiService;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id')
                    ->label('Rechercher un film')
                    ->searchable()
                    ->getSearchResultsUsing(function (string $query) {
                        $tmdbService = new TmdbApiService();
                        $movies = $tmdbService->searchMovies($query);

                        return collect($movies)->mapWithKeys(function ($movie) {
                            return [$movie['id'] => $movie['title'] . ' (' . Carbon::parse($movie['release_date'])->format('Y'). ')'];
                        })->toArray();
                    })
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Aucun film n\'a été ajouté à la liste')
            ->columns([
                ImageColumn::make('poster_path')
                    ->label('Poster')
                    ->width('lg'),
                TextColumn::make('title')
                    ->label('Titre')
                    ->description(function (Movie $movie){
                        return Str::of($movie->overview)->limit(100);
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('release_date')
                    ->label('Date de sortie')
                    ->date('Y')
                    ->sortable(),
                IconColumn::make('users_exists')
                    ->exists([
                        'users' => fn (Builder $query) => $query->where('user_id', auth()->user()->id),
                    ])->icon(fn (?int $state): string => match ($state) {
                        1 => 'heroicon-o-eye',
                        0 => 'heroicon-o-eye-slash',
                    })
                    ->label('Vu ?')
                    ->sortable(),
            ])
            ->filters([
                QueryBuilder::make()
                    ->constraints([
                        DateConstraint::make('release_date')->label('Date de sortie'),
                    ]),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

}
