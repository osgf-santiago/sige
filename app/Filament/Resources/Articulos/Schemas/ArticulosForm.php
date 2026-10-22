<?php

namespace App\Filament\Resources\Articulos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ArticulosForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('descripcion')
                    ->required(),
                TextInput::make('existencia')
                    ->required()
                    ->numeric(),
                TextInput::make('unidad')
                    ->required(),
            ]);
    }
}
