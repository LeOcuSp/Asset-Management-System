<?php

namespace App\Filament\User\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EventRegister;
use Filament\Resources\Resource;
use App\Filament\User\Resources\EventRegisterResource\Widgets\CalendarWidget;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\User\Resources\EventRegisterResource\Pages;
use App\Filament\User\Resources\EventRegisterResource\RelationManagers;

class EventRegisterResource extends Resource
{
    protected static ?string $model = EventRegister::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Asset Management';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->label('Event Name'),
                TextInput::make('type')->required(),

                DateTimePicker::make('start')
                    ->required()
                    ->seconds(false)
                    ->prefix('Start Time')
                    ->displayFormat('h:i A'),

                DateTimePicker::make('end')
                    ->required()
                    ->seconds(false)
                    ->suffix('End Time')
                    ->displayFormat('h:i A'),

                TextInput::make('location')->required(),
                Textarea::make('virtual_link')->required(),
                Toggle::make('online_only')->required(),
                Textarea::make('description')->required(),
                TextInput::make('slug')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Event Name')->searchable()->sortable(),
                TextColumn::make('type')->searchable()->sortable(),
                TextColumn::make('start')->date('d-M-Y h:i:A'),
                TextColumn::make('end')->date('d-M-Y h:i:A'),
                TextColumn::make('location')->searchable()->sortable(),
                TextColumn::make('virtual_link')
                    ->searchable()->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        str_contains($state, 'google') => 'primary',
                        str_contains($state, 'zoom') => 'success',
                        str_contains($state, 'microsoft') => 'info',
                        default => 'danger',
                    })
                    ->copyable()
                    ->label('Copy Link')
                    ->copyMessage('Meeting Link Copied')
                    ->formatStateUsing(fn ($state) => match (true) {
                        str_contains($state, 'google') => 'Google Meet',
                        str_contains($state, 'zoom') => 'Zoom Meeting',
                        str_contains($state, 'microsoft') => 'Microsoft Team',
                        default => 'Other Meeting',
                    })
                    ->icon('heroicon-o-link'),

                BooleanColumn::make('online_only')->label('Public Link'),
            ])
            ->recordUrl(null)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEventRegisters::route('/'),
            'create' => Pages\CreateEventRegister::route('/create'),
            'edit' => Pages\EditEventRegister::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CalendarWidget::class,
        ];
    }
}
