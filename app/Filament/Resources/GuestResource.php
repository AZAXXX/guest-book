<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Filament\Resources\GuestResource\RelationManagers;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\text;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('guest_id')->required(),
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone')->required(),
            TextInput::make('address')->required(),
            TextInput::make('organization')->required(),
            TextInput::make('identity_id')->required(),
            FileUpload::make('identity_file')->disk('public')->directory('identities'),
            TextInput::make('guest_token')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('id')->searchable(),
            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),
            
            TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            TextColumn::make('phone')
                ->label('Phone')
                ->sortable(),

            TextColumn::make('address')
                ->label('Address')
                ->limit(50) // Limit text to 50 characters
                ->sortable(),

            TextColumn::make('organization')
                ->label('Organization')
                ->sortable()
                ->searchable(),

            TextColumn::make('identity_id')
                ->label('Identity ID')
                ->sortable(),

                ImageColumn::make('author.avatar')->square()
                ->label('author.avatar')
                ->disk('public')
                ->size(50, 50),

            TextColumn::make('guest_token')
                ->label('Guest Token')
                ->copyable() // Allow copying of guest token
                ->sortable(),
            
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable(),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
