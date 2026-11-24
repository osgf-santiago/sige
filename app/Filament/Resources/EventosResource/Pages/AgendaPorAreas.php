<?php

namespace App\Filament\Resources\EventosResource\Pages;

use App\Filament\Resources\EventosResource;
use App\Models\Eventos;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class AgendaPorAreas extends Page
{
    protected static string $resource = EventosResource::class;

    protected string $view = 'filament.pages.agenda-por-areas';

    protected static ?string $title = 'Agenda por Áreas';

    public ?string $fechaFiltro = null;

    public function mount(): void
    {
        $this->fechaFiltro = now()->toDateString();
    }

    public function getEventosAgrupadosProperty(): Collection
    {
        $query = Eventos::query()
            ->with('area')
            ->orderBy('agenda');

        if (filled($this->fechaFiltro)) {
            $fecha = Carbon::parse($this->fechaFiltro);
            $query->whereDate('agenda', '<=', $fecha->toDateString())
                  ->whereDate('fin_evento', '>=', $fecha->toDateString());
        }

        return $query->get()->groupBy(function (Eventos $evento) {
            return $evento->area?->nombre ?? 'Sin área';
        });
    }
}