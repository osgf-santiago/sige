<x-filament-panels::page>
    <!-- Botón de impresión (se oculta al mandar a imprimir) -->
    <div class="flex justify-end mb-4 print:hidden">
        <x-filament::button color="primary" icon="heroicon-o-printer" onclick="window.print()">
            Imprimir Formato Carta
        </x-filament::button>
    </div>

    <!-- Contenedor principal que simula la hoja tamaño carta -->
    <div class="carta-container bg-white text-black p-8 mx-auto shadow-lg rounded-lg print:shadow-none print:p-0">
        
        <!-- ENCABEZADO INSTITUCIONAL -->
        <div class="border-b-2 border-gray-800 pb-4 mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold uppercase tracking-wide">Requisición de Artículos</h1>
                <p class="text-sm text-gray-600">Folio de Requisición: #{{ $record->id }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm"><strong>Estatus:</strong> <span class="px-2 py-1 bg-gray-100 border rounded">{{ $record->estatus }}</span></p>
                <p class="text-sm mt-1"><strong>Fecha de Emisión:</strong> {{ $record->created_at?->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- DATOS GENERALES -->
        <div class="grid grid-cols-2 gap-4 mb-6 text-sm bg-gray-50 p-4 rounded border border-gray-200 print:bg-white print:border-gray-300">
            <div>
                <p class="mb-1"><strong>Área Solicitante:</strong> {{ $record->area->nombre ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="mb-1"><strong>Solicitante:</strong> {{ $record->solicitante }}</p>
            </div>
        </div>

        <!-- TABLA DE ARTÍCULOS (DETALLES) -->
        <div class="mb-8">
            <h3 class="text-base font-semibold mb-3 border-b pb-1 text-gray-700">Artículos Solicitados</h3>
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead>
                    <tr class="bg-gray-100 print:bg-gray-200">
                        <th class="border border-gray-300 p-2 text-center w-12">#</th>
                        <th class="border border-gray-300 p-2 text-left">Descripción del Artículo</th>
                        <th class="border border-gray-300 p-2 text-center w-28">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($record->detalles as $index => $detalle)
                        <tr>
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <!-- Aquí toma la propiedad 'descripcion' de tu relación 'articulo' -->
                            <td class="border border-gray-300 p-2">{{ $detalle->articulo->descripcion ?? 'Artículo no especificado' }}</td>
                            <td class="border border-gray-300 p-2 text-center font-medium">{{ $detalle->cantidad }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border border-gray-300 p-4 text-center text-gray-500 italic">
                                No hay artículos registrados en esta requisición.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- SECCIÓN DE FIRMAS -->
        <div class="grid grid-cols-2 gap-16 mt-28 text-center pt-8">
            <div class="border-t border-gray-400 pt-2">
                <p class="text-sm font-semibold">Elaboró / Solicitante</p>
                <p class="text-xs text-gray-600 mt-1">{{ $record->solicitante }}</p>
            </div>
            <div class="border-t border-gray-400 pt-2">
                <p class="text-sm font-semibold">V° B° Jefatura de Área</p>
                <p class="text-xs text-gray-600 mt-1">Autorización</p>
            </div>
        </div>

    </div>

    <!-- ESTILOS CSS PARA SIMULAR CARTA Y CONFIGURAR IMPRESIÓN -->
    <style>
        .carta-container {
            max-width: 21.6cm; /* Ancho estándar carta */
            min-height: 27.9cm; /* Alto estándar carta */
        }

        @media print {
            body {
                background: white !important;
            }
            /* Ocultamos paneles, barras y botones de Filament al imprimir */
            .fi-topbar, .fi-sidebar, header, footer, nav, button, .print\:hidden {
                display: none !important;
            }
            .fi-main {
                padding: 0 !important;
                margin: 0 !important;
            }
            .carta-container {
                box-shadow: none !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            @page {
                size: letter;
                margin: 1.5cm;
            }
        }
    </style>
</x-filament-panels::page>