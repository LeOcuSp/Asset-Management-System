<?php

namespace App\Filament\User\Resources\AssetDonorResource\Pages;

use App\Filament\User\Resources\AssetDonorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetDonors extends ListRecords
{
    protected static string $resource = AssetDonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
