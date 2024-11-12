<?php

namespace App\Filament\Resources\GuestBookGuestResource\Pages;

use App\Filament\Resources\GuestBookGuestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuestBookGuest extends EditRecord
{
    protected static string $resource = GuestBookGuestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
