<?php

namespace App\Filament\Resources\OrdenesCompras\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdenesComprasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area.nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estatus'),
                Tables\Columns\TextColumn::make('solicitante')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('descargarPdf')
                ->label('PDF')
                ->color('success') // Color verde para diferenciarlo
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function ($record) {
                    $pdf = Pdf::loadView('filament.pages.oc', ['record' => $record]);
                    
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, 'OC-' . $record->id . '.pdf');
                }), 
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
