<?php

namespace App\Filament\User\Resources\AssetItemResource\Pages;



use Filament\Actions\Action;
use App\Imports\AssetItemImport;
use Filament\Actions\CreateAction;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\User\Resources\AssetItemResource;

class ListAssetItems extends ListRecords
{
    protected static string $resource = AssetItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('importAssetItems')
            ->label('Import Asset Items')
            ->color('danger')
            ->form([
                FileUpload::make('attachment')
            ])
            // ->icon('heroicon-o-document-down')
            ->action(function(array $data){
                $file = public_path('storage/'. $data['attachment']);

                Excel::import(new AssetItemImport, $file);

                Notification::make()
                ->title ('Asset Items Imported')
                ->success()
                ->send();
            })
            ->button()
        ];
    }
}
