<?php

namespace App\Filament\Resources\Cars\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                // TextColumn::make('slug')->searchable(),
                TextColumn::make('type')
                    ->badge(),
                TextColumn::make('transmission')
                    ->badge(),
                TextColumn::make('seats')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price_per_day')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),
                TextColumn::make('location')
                    ->searchable(),
                IconColumn::make('is_available')
                    ->boolean(),
                ImageColumn::make('image_url')->square(),
                ImageColumn::make('image_path')->disk('public')->square(),
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
