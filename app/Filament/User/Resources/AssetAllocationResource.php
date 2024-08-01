<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AssetAllocation;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\AssetAllocationResource\Pages;
use App\Filament\User\Resources\AssetAllocationResource\RelationManagers;
use App\Filament\User\Resources\AssetAllocationResource\Pages\EditAssetAllocation;
use App\Filament\User\Resources\AssetAllocationResource\Pages\ListAssetAllocations;
use App\Filament\User\Resources\AssetAllocationResource\Pages\CreateAssetAllocation;

class AssetAllocationResource extends Resource
{
    protected static ?string $model = AssetAllocation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')->required(),
                TextInput::make('allocated_from')->required(),
                TextInput::make('allocated_to')->required(),
                Select::make('asset_item_id')
                ->label('Select Asset Number')
                ->relationship('assetItem','asset_number')
                ->nullable()
                ->unique(ignoreRecord: true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date'),
                TextColumn::make('allocated_from'),
                TextColumn::make('allocated_to'),
                TextColumn::make('assetItem.asset_number')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssetAllocations::route('/'),
            'create' => Pages\CreateAssetAllocation::route('/create'),
            'edit' => Pages\EditAssetAllocation::route('/{record}/edit'),
        ];
    }
}
