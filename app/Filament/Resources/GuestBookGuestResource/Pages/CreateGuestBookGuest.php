<?php

namespace App\Filament\Resources\GuestBookGuestResource\Pages;

use App\Filament\Resources\GuestBookGuestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuestBookGuest extends CreateRecord
{
    protected static string $resource = GuestBookGuestResource::class;
}
