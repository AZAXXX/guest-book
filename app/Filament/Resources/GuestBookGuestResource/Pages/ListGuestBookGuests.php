<?php

namespace App\Filament\Resources\GuestBookGuestResource\Pages;

use App\Filament\Resources\GuestBookGuestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuestBookGuests extends ListRecords
{
    protected static string $resource = GuestBookGuestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
