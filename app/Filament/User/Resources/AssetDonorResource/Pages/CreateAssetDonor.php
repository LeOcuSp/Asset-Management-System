<?php

namespace App\Filament\User\Resources\AssetDonorResource\Pages;

use App\Filament\User\Resources\AssetDonorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetDonor extends CreateRecord
{
    protected static string $resource = AssetDonorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Create Donor Successful';
    }
}
