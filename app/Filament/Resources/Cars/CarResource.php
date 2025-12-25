<?php

namespace App\Filament\Resources\Cars;

use App\Models\Admin;
use App\Models\Car;
use App\Models\Reservation;
use App\Filament\Resources\Cars\Pages\EditCar;
use App\Filament\Resources\Cars\Pages\ListCars;
use App\Filament\Resources\Cars\Pages\CreateCar;
use App\Filament\Resources\Cars\Schemas\CarForm;
use App\Filament\Resources\Cars\Tables\CarsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

     protected static string|\UnitEnum|null $navigationGroup = 'Car Management';

    protected static ?string $recordTitleAttribute = 'name';

    protected static function adminIsSuper(): bool
    {
        $user = auth('admin')->user();

        return $user instanceof Admin && $user->isSuperAdmin();
    }

    public static function canViewAny(): bool
    {
        return static::adminIsSuper();
    }

    public static function canCreate(): bool
    {
        return static::adminIsSuper();
    }

    public static function canEdit($record): bool
    {
        return static::adminIsSuper();
    }

    public static function canDelete($record): bool
    {
        return static::adminIsSuper();
    }

    public static function canDeleteAny(): bool
    {
        return static::adminIsSuper();
    }

    public static function form(Schema $schema): Schema
    {
        return CarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarsTable::configure($table);
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
            'index' => ListCars::route('/'),
            'create' => CreateCar::route('/create'),
            'edit' => EditCar::route('/{record}/edit'),
        ];
    }
}
