<?php

namespace App\Filament\User\Resources\EventRegisterResource\Pages;

use App\Filament\User\Resources\EventRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventRegister extends EditRecord
{
    protected static string $resource = EventRegisterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Edit Event Successful';
    }

}
