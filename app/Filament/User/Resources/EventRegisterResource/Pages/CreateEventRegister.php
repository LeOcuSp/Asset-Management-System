<?php

namespace App\Filament\User\Resources\EventRegisterResource\Pages;

use App\Filament\User\Resources\EventRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventRegister extends CreateRecord
{
    protected static string $resource = EventRegisterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Create Event Successful';
    }

}
