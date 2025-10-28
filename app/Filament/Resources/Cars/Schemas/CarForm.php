<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                // TextInput::make('slug')
                //     ->helperText('Leave blank to auto-generate from name')
                //     ->nullable(),
                Select::make('type')
                    ->options([
                        'sedan' => 'Sedan',
                        'suv' => 'Suv',
                        'luxury' => 'Luxury',
                        'ev' => 'Ev',
                        'van' => 'Van',
                        'pickup' => 'Pickup',
                    ])
                    ->required(),
                Select::make('transmission')
                    ->options(['automatic' => 'Automatic', 'manual' => 'Manual'])
                    ->required(),
                TextInput::make('seats')
                    ->required()
                    ->numeric(),
                TextInput::make('price_per_day')
                    ->required()
                    ->numeric(),
                TextInput::make('location')
                    ->required(),
                Toggle::make('is_available'),
                TextInput::make('image_url')
                    ->url(),
                FileUpload::make('image_path')
                    ->disk('public')
                    ->directory('cars')
                    ->image()
                    ->visibility('public')
                    ->imageEditor(),
                // KeyValue::make('features')
                //     ->nullable()
                //     ->helperText('Optional key/value features, stored as JSON'),
            ]);
    }
}
