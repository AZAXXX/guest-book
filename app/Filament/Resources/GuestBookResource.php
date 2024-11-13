<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\GuestBook;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;

use App\Filament\Resources\GuestBookResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\GuestBookResource\RelationManagers;
use App\Models\Guest;

class GuestBookResource extends Resource
{
    protected static ?string $model = GuestBook::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('guest_id')
                    ->relationship(name: 'guest', titleAttribute: 'name')
                    ->createOptionForm([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('phone')->required(),
                        TextInput::make('address')->required(),
                        TextInput::make('organization')->required(),
                        TextInput::make('identity_id')->required(),
                        FileUpload::make('identity_file')->disk('public')->directory('identities'),
                        // TextInput::make('guest_token')->required(),

                    ])
                    ->createOptionUsing(function (array $data) {
                        // Generate guest token
                        $data['guest_token'] = Str::random(8);
                
                        // Return data yang sudah dimodifikasi
                        return Guest::create($data)->getKey();
                    }),
                Select::make('host_id')
                    ->relationship('host', 'name')
                    ->required(),
                Select::make('organization_id')
                    ->relationship('organization', 'name')
                    ->required(),
                Textarea::make('needs')->required(),
                DateTimePicker::make('check_in')->required(),
                DateTimePicker::make('check_out')->required(),
                Select::make('status')
                ->default('pending')
                ->visible(fn () => Auth::check() && Auth::user()->hasRole('Super Admin'))
                ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'declined' => 'Declined',

                    ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('guest_id'),
                TextColumn::make('host.name')
                    ->label('Host')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('organization.name')
                    ->label('Organization')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('needs')
                    ->label('Needs')
                    ->limit(50),

                TextColumn::make('check_in')
                    ->label('Check In')
                    ->sortable(),

                TextColumn::make('check_out')
                    ->label('Check Out')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'primary',
                        'secondary' => 'draft',
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'declined',
                    ])
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
    public static function getTableQuery(): Builder
    {
        // Menggunakan eager loading untuk relationship
        return parent::getTableQuery()->with(['guest', 'host', 'organization']);
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
            'index' => Pages\ListGuestBooks::route('/'),
            'create' => Pages\CreateGuestBook::route('/create'),
            'edit' => Pages\EditGuestBook::route('/{record}/edit'),
        ];
    }
}
