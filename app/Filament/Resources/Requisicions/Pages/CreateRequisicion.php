<?php

namespace App\Filament\Resources\Requisicions\Pages;

use App\Filament\Resources\Requisicions\RequisicionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRequisicion extends CreateRecord
{
    protected static string $resource = RequisicionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');

    }
}
