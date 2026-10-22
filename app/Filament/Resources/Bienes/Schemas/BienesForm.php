<?php

namespace App\Filament\Resources\Bienes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BienesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_udg')
                    ->required()
                    ->numeric(),
                Textarea::make('cog_descripcion')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('clasificador')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('clasificador_descripcion')
                    ->default(null),
                TextInput::make('id_resguardante')
                    ->numeric()
                    ->default(null),
                TextInput::make('nombre_resguardante')
                    ->default(null),
                TextInput::make('fecha_adquisicion')
                    ->default(null),
                TextInput::make('descripcion')
                    ->default(null),
                TextInput::make('origen')
                    ->default(null),
                TextInput::make('tram_alta')
                    ->default(null),
                TextInput::make('marca')
                    ->default(null),
                TextInput::make('modelo')
                    ->default(null),
                TextInput::make('num_serie')
                    ->default(null),
                TextInput::make('id_tipo_siiau')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
