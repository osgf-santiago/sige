<?php

namespace App\Filament\Resources\TicketResource\RelationManagers;

use App\Enums\TicketStatus;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';

    protected static ?string $title = 'Historial y Seguimiento';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => Auth::id()),

                Forms\Components\Select::make('tipo')
                    ->label('Tipo de Entrada')
                    ->options([
                        'comentario' => 'Comentario Público',
                        'nota_interna' => 'Nota Interna (Técnicos)',
                        'cambio_estatus' => 'Cambio de Estado',
                    ])
                    ->default('comentario')
                    ->required(),

                Forms\Components\Textarea::make('comentario')
                    ->label('Detalle / Observaciones')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('ruta_adjuntos')
                    ->label('Adjuntar Evidencia')
                    ->directory('ticket_historiales')
                    ->visibility('private')
                    ->maxSize(10240)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('comentario')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'comentario' => 'Comentario',
                        'nota_interna' => 'Nota Interna',
                        'cambio_estatus' => 'Cambio de Estado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'comentario' => 'info',
                        'nota_interna' => 'warning',
                        'cambio_estatus' => 'gray',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('comentario')
                    ->label('Detalle')
                    ->limit(60)
                    ->wrap(),

                Tables\Columns\IconColumn::make('ruta_adjuntos')
                    ->label('Adjunto')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon(''),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar Entrada'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }
}