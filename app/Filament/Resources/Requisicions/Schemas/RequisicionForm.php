<?php

namespace App\Filament\Resources\Requisicions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;


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
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(3) 
                    ->defaultItems(1) 
                    ->addActionLabel('Agregar otro artículo')
                    ->reorderable(false)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
