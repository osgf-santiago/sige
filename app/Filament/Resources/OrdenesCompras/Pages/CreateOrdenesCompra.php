<?php

namespace App\Filament\Resources\OrdenesCompras\Pages;

use App\Filament\Resources\OrdenesCompras\OrdenesCompraResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrdenesCompra extends CreateRecord
{
    protected static string $resource = OrdenesCompraResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');

    }
}
