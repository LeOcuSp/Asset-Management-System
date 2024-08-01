<?php

namespace App\Filament\User\Resources\AssetAllocationResource\Pages;

use App\Filament\User\Resources\AssetAllocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetAllocation extends EditRecord
{
    protected static string $resource = AssetAllocationResource::class;

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
        return 'Edit Asset Allocation Successful';
    }
}
