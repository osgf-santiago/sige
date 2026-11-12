<?php

namespace App\Filament\Resources\Requisicions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use App\Models\Articulos;

class RequisicionForm
{
    public static function configure(Schema $schema): Schema
    {
         return $schema
            ->schema([
                Forms\Components\Select::make('area_id')
                    ->relationship('area', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),
                 Forms\Components\Select::make('estatus')
                    ->options([
                        'Nueva' => 'Nueva',
                        'En Revisión' => 'En Revisión',
                        'Rechazada' => 'Rechazada',
                        'Aprobada' => 'Aprobada',
                    ])
                    ->default('Nueva')
                    ->required(),
                Forms\Components\TextInput::make('solicitante')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Repeater::make('detalles')
                    ->label('Artículos de la Requisición')
                    ->relationship('detalles') 
                    ->schema([
                        Forms\Components\Select::make('articulo_id')
                            ->label('Artículo')
                            ->relationship('articulo', 'descripcion')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state) {
                                    $articulo = \App\Models\Articulos::find($state);
                                    $set('unidad', $articulo?->unidad ?? ''); 
                                } else {
                                    $set('unidad', '');
                                }
                            })
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('unidad')
                            ->label('Unidad')
                            ->disabled()
                            ->dehydrated()
                            ->afterStateHydrated(function (Forms\Components\TextInput $component, $state, $get) {
                                $articuloId = $get('articulo_id');
                                if ($articuloId) {
                                    $articulo = \App\Models\Articulos::find($articuloId);
                                    $component->state($articulo?->unidad ?? '');
                                }
                            })
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(4) 
                    ->defaultItems(1) 
                    ->addActionLabel('Agregar otro artículo')
                    ->reorderable(false)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
