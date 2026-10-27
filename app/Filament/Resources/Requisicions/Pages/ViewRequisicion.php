<?php

namespace App\Filament\Resources\Requisicions\Pages;

use App\Filament\Resources\Requisicions\RequisicionResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\ViewRecord;

class ViewRequisicion extends ViewRecord
{
    protected static string $resource = RequisicionResource::class;

    // Apunta exactamente a la ruta de tu vista Blade
    protected string $view = 'filament.pages.requisicion';
}