<?php

namespace App\Filament\Resources\Bienes\Pages;

use App\Filament\Resources\Bienes\BienesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBienes extends EditRecord
{
    protected static string $resource = BienesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
