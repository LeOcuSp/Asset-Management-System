<?php

namespace App\Filament\User\Resources\AssetCategoryResource\Pages;

use App\Filament\User\Resources\AssetCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetCategory extends CreateRecord
{
    protected static string $resource = AssetCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Create Asset Category Successful';
    }
}
