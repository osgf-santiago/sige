<?php

namespace App\Filament\Resources\Bienes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BienesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_udg')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('clasificador_descripcion')
                    ->searchable(),
                TextColumn::make('id_resguardante')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nombre_resguardante')
                    ->searchable(),
                TextColumn::make('fecha_adquisicion')
                    ->searchable(),
                TextColumn::make('descripcion')
                    ->searchable(),
                TextColumn::make('origen')
                    ->searchable(),
                TextColumn::make('tram_alta')
                    ->searchable(),
                TextColumn::make('marca')
                    ->searchable(),
                TextColumn::make('modelo')
                    ->searchable(),
                TextColumn::make('num_serie')
                    ->searchable(),
                TextColumn::make('id_tipo_siiau')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
