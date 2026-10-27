<?php

namespace App\Filament\Resources\DocumentosResource\Pages;

use App\Filament\Resources\DocumentosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentos extends CreateRecord
{
    protected static string $resource = DocumentosResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');

    }
}
