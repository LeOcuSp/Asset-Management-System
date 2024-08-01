<?php

namespace App\Filament\User\Resources\AssetDamageResource\Pages;

use App\Filament\User\Resources\AssetDamageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetDamage extends EditRecord
{
    protected static string $resource = AssetDamageResource::class;

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
        return 'Edit Damage Item Successful';
    }
}
