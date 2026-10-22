<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtensionResource\Pages;
use App\Filament\Resources\ExtensionResource\RelationManagers;
use App\Models\Extension;
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

class ExtensionResource extends Resource
{
    protected static ?string $model = Extension::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-folder';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('extension')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('area_id')
                    ->relationship('area', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('personas')
                    ->maxLength(255)
                    ->default(null),
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('extension')
                    ->searchable(),
                Tables\Columns\TextColumn::make('area.nombre')
                    ->label('Área')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('area.piso')
                    ->label('Piso')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('area.edificio')
                    ->label('Edificio')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('personas')
                    ->searchable(),
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
            'index' => Pages\ListExtensions::route('/'),
            'create' => Pages\CreateExtension::route('/create'),
            'edit' => Pages\EditExtension::route('/{record}/edit'),
        ];
    }
}
