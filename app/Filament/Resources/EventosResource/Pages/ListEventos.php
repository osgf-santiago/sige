<?php

namespace App\Filament\Resources\EventosResource\Pages;

use App\Filament\Resources\EventosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventos extends ListRecords
{
    protected static string $resource = EventosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('agendaPorAreas')
                ->label('Vista por áreas')
                ->icon('heroicon-o-calendar-days')
                ->url(EventosResource::getUrl('agenda-areas')),
            Actions\CreateAction::make()
            ->label('Nuevo evento'),
        ];
    }
}
