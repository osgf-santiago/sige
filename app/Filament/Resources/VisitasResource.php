<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitasResource\Pages;
use App\Filament\Resources\VisitasResource\RelationManagers;
use App\Models\Visitas;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Widgets\RequisicionesPorAreaChart;

class VisitasResource extends Resource
{
    protected static ?string $model = Visitas::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-folder';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('area_id')
                    ->relationship('area', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('identificador')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('area.nombre')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('identificador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Hora de registro')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListVisitas::route('/'),
            'create' => Pages\CreateVisitas::route('/create'),
            'edit' => Pages\EditVisitas::route('/{record}/edit'),
        ];
    }
    public static function getWidgets(): array
    {
        return [
            RequisicionesPorAreaChart::class,
        ];
    }
}
