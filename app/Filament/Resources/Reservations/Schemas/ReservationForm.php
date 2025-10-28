<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_id')
                    ->relationship('car', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('pickup_location')
                    ->required(),
                DatePicker::make('pickup_date')
                    ->required(),
                TimePicker::make('pickup_time')
                    ->required(),
                Radio::make('pickup_method')
                    ->options([
                        'self_pickup' => 'Self pickup',
                        'delivery' => 'Delivery',
                    ])
                    ->default('self_pickup')
                    ->inline()
                    ->live(),
                TextInput::make('delivery_address')
                    ->label('Delivery address')
                    ->visible(fn (callable $get) => $get('pickup_method') === 'delivery')
                    ->required(fn (callable $get) => $get('pickup_method') === 'delivery'),
                DatePicker::make('return_date')
                    ->required(),
                TimePicker::make('return_time')
                    ->required(),
                Select::make('status')
                    ->options([
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
        ])
                    ->required(),
                TextInput::make('total_price')
                    ->numeric(),
                KeyValue::make('extras')->nullable(),
            ]);
    }
}
