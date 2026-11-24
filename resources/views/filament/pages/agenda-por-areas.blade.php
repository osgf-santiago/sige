<x-filament-panels::page>
    <style>
        .agenda-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            padding: 1rem;
        }

        .agenda-header {
            display: none;
        }

        @media (min-width: 768px) {
            .agenda-header {
                display: grid;
                grid-template-columns: 200px minmax(0, 1fr) 110px;
                gap: 1.5rem;
                padding: 0.625rem 1rem;
                align-items: center;
            }

            .agenda-row {
                grid-template-columns: 200px minmax(0, 1fr) 110px;
                gap: 1.5rem;
                padding: 1rem;
                align-items: start;
                border-top: 1px dashed rgba(156, 163, 175, 0.45);
            }

            .agenda-action {
                justify-self: end;
            }
        }

    </style>

    <x-filament::section class="mb-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="flex flex-wrap items-end gap-3">
                <div class="flex w-fit flex-col gap-1">
                    <label for="fechaFiltro" class="text-sm font-medium">Filtrar por día</label>
                    <input
                        id="fechaFiltro"
                        type="date"
                        wire:model.live="fechaFiltro"
                        class="fi-input w-40 rounded-lg border-gray-300 text-sm shadow-sm dark:border-gray-700 dark:bg-gray-900"
                    />
                </div>

                <x-filament::button
                    color="gray"
                    size="sm"
                    wire:click="$set('fechaFiltro', '{{ now()->toDateString() }}')"
                >
                    Hoy
                </x-filament::button>

                @if($fechaFiltro)
                    <x-filament::button
                        color="gray"
                        size="sm"
                        wire:click="$set('fechaFiltro', null)"
                    >
                        Todos los días
                    </x-filament::button>
                @endif
            </div>

            <div class="text-xs text-gray-500 dark:text-gray-400">
                @if($fechaFiltro)
                    Mostrando: <strong>{{ \Illuminate\Support\Carbon::parse($fechaFiltro)->translatedFormat('l d/m/Y') }}</strong>
                @else
                    Mostrando todos los días
                @endif
            </div>
        </div>
    </x-filament::section>

    @php
        $grupos = $this->eventosAgrupados;
    @endphp

    @if($grupos->isEmpty())
        <x-filament::section>
            <p class="text-sm font-medium">No hay eventos programados para esta selección.</p>
        </x-filament::section>
    @else
        <div class="space-y-8">
            @foreach($grupos as $nombreArea => $eventosArea)
                <x-filament::section :heading="$nombreArea" class="mb-6">
                    <x-slot name="headerEnd">
                        <x-filament::badge>
                            {{ $eventosArea->count() }} {{ \Illuminate\Support\Str::plural('evento', $eventosArea->count()) }}
                        </x-filament::badge>
                    </x-slot>

                    <div class="agenda-header border-b border-gray-200 text-xs font-semibold uppercase tracking-wide text-gray-500 dark:border-gray-700 dark:text-gray-400">
                        <div>Horario</div>
                        <div>Evento</div>
                        <div class="text-right">Acción</div>
                    </div>

                    <div class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($eventosArea as $evento)
                            @php
                                $inicio = \Illuminate\Support\Carbon::parse($evento->agenda);
                                $fin = \Illuminate\Support\Carbon::parse($evento->fin_evento);
                            @endphp

                            <div class="agenda-row">
                                <div>
                                    <div class="text-sm font-semibold text-gray-950 dark:text-white">
                                        {{ $inicio->format('H:i') }} – {{ $fin->format('H:i') }}
                                    </div>
                                    <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                        {{ $inicio->translatedFormat('D d/m/Y') }}
                                    </div>
                                </div>

                                <div>
                                    <div class="text-sm font-semibold text-gray-950 dark:text-white">
                                        {{ $evento->nombre }}
                                    </div>
                                    @if($evento->descripcion)
                                        <p class="mt-1 text-xs leading-relaxed text-gray-600 dark:text-gray-300">
                                            {{ $evento->descripcion }}
                                        </p>
                                    @endif
                                </div>

                                <div class="agenda-action">
                                    <x-filament::link
                                        size="sm"
                                        :href="\App\Filament\Resources\EventosResource::getUrl('edit', ['record' => $evento])"
                                    >
                                        Editar
                                    </x-filament::link>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    
                </x-filament::section>
            </br>
            @endforeach
        </div>
    @endif
</x-filament-panels::page>