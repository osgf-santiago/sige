<?php

namespace App\Filament\Resources\VisitasResource\Pages;

use App\Filament\Resources\VisitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\VisitasResource\Widgets\VisitasPorAreaChart;

class ListVisitas extends ListRecords
{
    protected static string $resource = VisitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            VisitasPorAreaChart::class,
        ];
    }
}
