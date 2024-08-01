<?php

namespace App\Filament\User\Resources\AssetDamageResource\Pages;

use App\Filament\User\Resources\AssetDamageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetDamages extends ListRecords
{
    protected static string $resource = AssetDamageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
