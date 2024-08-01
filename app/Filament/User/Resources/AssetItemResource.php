<?php
namespace App\Filament\User\Resources;

use Filament\Forms;
use App\Models\AssetItem;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use App\Exports\AssetItemExport;
use App\Imports\AssetItemImport;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\User\Resources\AssetItemResource\Pages;
use App\Filament\User\Resources\AssetItemResource\RelationManagers;
use App\Filament\User\Resources\AssetItemResource\Pages\EditAssetItem;
use App\Filament\User\Resources\AssetItemResource\Pages\ListAssetItems;
use App\Filament\User\Resources\AssetItemResource\Pages\CreateAssetItem;

class AssetItemResource extends Resource
{
    protected static ?string $model = AssetItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?int $navigationSort = 5;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('asset_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('asset_donors_id')
                    ->label('Donor')
                    ->relationship('donor', 'name')
                    ->nullable(),
                Select::make('status')
                    ->label('Status')
                    ->default('Active')
                    ->options([
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                    ]),
                Placeholder::make('latest_allocation')
                    ->label('Latest Allocation')
                    ->content(function ($record) {
                        if ($record && $record->latestAllocation) {
                            return $record->latestAllocation->allocated_to;
                        } else {
                            return 'No allocations yet';
                        }
                    }),
                TextInput::make('brand')->required(),
                TextInput::make('model')->required(),
                DatePicker::make('date_of_purchase')->required(),
                TextInput::make('description')->nullable(),
                TextInput::make('serial_number')->required()->unique(ignoreRecord: true),
                TextInput::make('asset_number')->required()->unique(ignoreRecord: true),
                DatePicker::make('date_of_warranty')->required(),
                TextInput::make('location')->required(),
                TextInput::make('vendor')->required(),
                TextInput::make('purchased_price')
                    ->required()
                    ->prefix('THB')
                    ->afterStateHydrated(function ($state, $set) {
                        $set('purchased_price', 'THB ' . number_format((float)$state, 2, '.', ','));
                    })
                    ->afterStateUpdated(function ($state, $set) {
                        $set('purchased_price', 'THB ' . number_format((float)$state, 2, '.', ','));
                    }),
                TextInput::make('remark')->nullable(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category')->searchable()->sortable(),
                TextColumn::make('brand')->searchable()->sortable(),
                TextColumn::make('model')->searchable()->sortable(),
                TextColumn::make('date_of_purchase')->date()->searchable()->sortable(),
                TextColumn::make('serial_number')->searchable()->sortable(),
                TextColumn::make('asset_number')->searchable()->sortable(),
                TextColumn::make('status')->badge()->color(fn ($state) => $state === 'Active' ? 'success' : 'danger'),
                TextColumn::make('date_of_warranty')->date(),
                TextColumn::make('donor.name')->label('Donor')->searchable()->sortable(),
                TextColumn::make('location')->searchable()->sortable(),
                TextColumn::make('vendor')->searchable()->sortable(),
                TextColumn::make('purchased_price'),
            ])
            ->searchable()
            ->recordUrl(null)
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Download Asset Items')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function () {
                        $records = AssetItem::with('category')->get();
                        return Excel::download(new AssetItemExport($records), 'asset_items.xlsx');
                    }),
                
                Action::make('download_sample_excel')
                    ->label('Download Sample Form')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(route('download-sample-excel')),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
                BulkAction::make('export')
                    ->label('Download Asset Items')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function (Collection $records) {
                        return Excel::download(new AssetItemExport($records), 'asset_items.xlsx');
                    }),
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
            'index' => Pages\ListAssetItems::route('/'),
            'create' => Pages\CreateAssetItem::route('/create'),
            'edit' => Pages\EditAssetItem::route('/{record}/edit'),
        ];
    }
}
