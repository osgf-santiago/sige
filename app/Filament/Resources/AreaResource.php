<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AreaResource\Pages;
use App\Filament\Resources\AreaResource\RelationManagers;
use App\Models\Area;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información del Área')
                    ->description('Ingrese la localización y tipo de área.')
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->label('Nombre del Área')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej. Recursos Humanos'),

                        Forms\Components\TextInput::make('edificio')
                            ->label('Edificio')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej. Edificio A'),

                        Forms\Components\TextInput::make('piso')
                            ->label('Piso')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej. Piso 3'),

                        Forms\Components\Select::make('tipo')
                            ->label('Tipo de Área')
                            ->options([
                                'Administrativa' => 'Administrativa',
                                'Operaciones' => 'Operaciones',
                                'Gestión' => 'Gestión',
                            ])
                            ->default('Operaciones')
                            ->required()
                            ->native(false),

                        Forms\Components\Toggle::make('esta_activo')
                            ->label('¿Área Activa?')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('edificio')
                    ->label('Edificio')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('piso')
                    ->label('Piso')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Administrativa' => 'info',
                        'Operaciones' => 'warning',
                        'Gestión' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\IconColumn::make('esta_activo')
                    ->label('Estado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro por Estado (Activo/Inactivo)
                Tables\Filters\TernaryFilter::make('esta_activo')
                    ->label('Estado')
                    ->trueLabel('Solo Activas')
                    ->falseLabel('Solo Inactivas'),

                // Filtro por Tipo de Área
                Tables\Filters\SelectFilter::make('tipo')
                    ->label('Tipo de Área')
                    ->options([
                        'Administrativa' => 'Administrativa',
                        'Operaciones' => 'Operaciones',
                        'Gestión' => 'Gestión',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAreas::route('/'),
            'create' => Pages\CreateArea::route('/create'),
            'edit' => Pages\EditArea::route('/{record}/edit'),
        ];
    }
}
