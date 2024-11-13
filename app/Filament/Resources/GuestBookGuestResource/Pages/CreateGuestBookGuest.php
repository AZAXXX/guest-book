<?php

namespace App\Filament\Resources\GuestBookGuestResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\GuestBookGuestResource;

class CreateGuestBookGuest extends CreateRecord
{
    protected static string $resource = GuestBookGuestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
     $data['guest_token'] = Str::random(8);
    if ($data['status']=== null)  {
        $data['status'] = 'proses';
    }

    // dd($data);
 
    return $data;
}

}