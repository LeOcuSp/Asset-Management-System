<?php

namespace App\Filament\User\Resources\EventRegisterResource\Pages;

use App\Filament\User\Resources\EventRegisterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventRegisters extends ListRecords
{
    protected static string $resource = EventRegisterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
