<?php

namespace App\Filament\User\Resources\AssetItemResource\Pages;

use App\Filament\User\Resources\AssetItemResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetItem extends EditRecord
{
    protected static string $resource = AssetItemResource::class;

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
        return 'Edit Asset Item Successful';
    }
}
