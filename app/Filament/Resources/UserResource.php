<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use App\Filament\Resources\UserResource\Pages;
use Filament\Schemas\Components\Form as SchemaForm;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';

    protected static string|\UnitEnum|null $navigationGroup = 'User Management';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            SchemaForm::make()->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->confirmed()
                    ->minLength(8)
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->required(fn(string $context) => $context === 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->label('Password'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->minLength(8)
                    ->visible(fn(string $context) => $context === 'create')
                    ->label('Confirm Password'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('1s')
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Joined'),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                Action::make('resetPassword')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->form([
                        Forms\Components\Toggle::make('generate')
                            ->label('Generate a random password')
                            ->default(true),
                        Forms\Components\TextInput::make('new_password')
                            ->password()
                            ->minLength(8)
                            ->dehydrated(false)
                            ->visible(fn(callable $get) => ! $get('generate')),
                    ])
                    ->action(function (User $record, array $data) {
                        $password = ($data['generate'] ?? true)
                            ? Str::random(12)
                            : ($data['new_password'] ?? Str::random(12));
                        $record->update(['password' => Hash::make($password)]);

                        Notification::make()
                            ->title('Password reset')
                            ->body('New password: ' . $password)
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
