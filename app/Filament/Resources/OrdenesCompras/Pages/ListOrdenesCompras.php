<?php

namespace App\Filament\Resources\OrdenesCompras\Pages;

use App\Filament\Resources\OrdenesCompras\OrdenesCompraResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrdenesCompras extends ListRecords
{
    protected static string $resource = OrdenesCompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
