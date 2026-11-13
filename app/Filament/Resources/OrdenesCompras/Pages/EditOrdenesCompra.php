<?php

namespace App\Filament\Resources\OrdenesCompras\Pages;

use App\Filament\Resources\OrdenesCompras\OrdenesCompraResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrdenesCompra extends EditRecord
{
    protected static string $resource = OrdenesCompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
