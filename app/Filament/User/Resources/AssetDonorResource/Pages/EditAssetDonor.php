<?php

namespace App\Filament\User\Resources\AssetDonorResource\Pages;

use App\Filament\User\Resources\AssetDonorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetDonor extends EditRecord
{
    protected static string $resource = AssetDonorResource::class;

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
        return 'Edit Donor Successful';
    }
}
