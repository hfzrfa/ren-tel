<?php

namespace App\Filament\Resources\Reservations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('car.name')
                    ->label('Car')
                    ->searchable(),
                // TextColumn::make('user_id')->numeric()->sortable(),
                TextColumn::make('full_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('pickup_location')
                    ->searchable(),
                TextColumn::make('pickup_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('pickup_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('pickup_method')
                    ->label('Pickup')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'delivery' ? 'Delivery' : 'Self pickup'),
                TextColumn::make('delivery_address')
                    ->label('Delivery address')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('return_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('return_time')
                    ->time()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('total_price')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
