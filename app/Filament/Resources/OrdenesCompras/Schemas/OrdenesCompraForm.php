<?php

namespace App\Filament\Resources\OrdenesCompras\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class OrdenesCompraForm
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
                    ->label('Artículos de la orden de compra')
                    ->relationship('detalles') 
                    ->schema([
                        Forms\Components\TextInput::make('cantidad')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get) {
                                // Calculamos el subtotal multiplicando cantidad * precio_unitario
                                $cantidad = (float) ($get('cantidad') ?? 0);
                                $precio = (float) ($get('precio_unitario') ?? 0);
                                $set('sub_total', round($cantidad * $precio, 2));
                            })
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('descripcion')
                            ->label('Descripción')
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('precio_unitario')
                            ->label('Precio Unitario')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->prefix('$')
                            ->reactive()
                            ->afterStateUpdated(function ($set, $get) {
                                // Calculamos el subtotal multiplicando cantidad * precio_unitario
                                $cantidad = (float) ($get('cantidad') ?? 0);
                                $precio = (float) ($get('precio_unitario') ?? 0);
                                $set('sub_total', round($cantidad * $precio, 2));
                            })
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('sub_total')
                            ->label('Sub Total')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->prefix('$')
                            ->columnSpan(1),

                    ])
                    ->columns(5) 
                    ->defaultItems(1) 
                    ->addActionLabel('Agregar otro artículo')
                    ->reorderable(false)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
