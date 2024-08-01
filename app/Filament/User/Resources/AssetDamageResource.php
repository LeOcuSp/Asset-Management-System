<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\AssetItem;
use Filament\Tables\Table;
use App\Models\AssetDamage;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\AssetDamageResource\Pages;
use App\Filament\User\Resources\AssetDamageResource\RelationManagers;

class AssetDamageResource extends Resource
{
    protected static ?string $model = AssetDamage::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';
    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date'),
                
                Select::make('asset_item_id')
                ->label('Select Asset Number')
                ->relationship('assetItem','asset_number')
                ->nullable()
                ->unique(ignoreRecord:true),

                Select::make('asset_category_id')
                ->label('Category')
                ->relationship('category', 'name')
                ->required(),

                Select::make('status')
                ->label('Status Condition')
                ->options([
                    'damage' => 'Damage',
                    'stolen' => 'Stolen',
                    'lost' => 'Lost',
                    'repair' => 'Repair'
                ])

                ->required()
                ->afterStateUpdated(function ($state, Get $get) {
                    $assetItem = \App\Models\AssetItem::find($get('asset_item_id'));
                    if ($assetItem && in_array($state, ['damage', 'stolen', 'lost', 'repair'])) {
                        $assetItem->update(['status' => 'Inactive']);
                    } elseif ($assetItem && $state === 'repair') {
                        $assetItem->update(['status' => 'Active']);
                    }
                    }),

                TextInput::make('reported_by'),
                TextInput::make('location_of_damage'),
                TextInput::make('reason'),
                TextInput::make('remark'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date'),
                TextColumn::make('status'),
                TextColumn::make('assetItem.asset_number')->label('Asset Number'),
                TextColumn::make('reported_by'),
                TextColumn::make('location_of_damage'),
                TextColumn::make('remark'),
            ])
            ->recordUrl(null)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAssetDamages::route('/'),
            'create' => Pages\CreateAssetDamage::route('/create'),
            'edit' => Pages\EditAssetDamage::route('/{record}/edit'),
        ];
    }
}
