<?php

namespace App\Filament\Resources\VisitasResource\Widgets;

use App\Models\Area;
use Filament\Widgets\ChartWidget;

class VisitasPorAreaChart extends ChartWidget
{
    protected ?string $heading = 'Visitas Por Área';

    protected function getData(): array
    {
        $areas = Area::withCount('visitas')->get();
        return [
            'datasets' => [
                [
                    'label' => 'Total por Área',
                    'data' => $areas->pluck('visitas_count')->toArray(),
                    'backgroundColor' => [
                        '#3b82f6', '#ef4444', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'
                    ],
                ],
            ],
            'labels' => $areas->pluck('nombre')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
