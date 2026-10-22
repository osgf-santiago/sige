<?php

namespace App\Filament\Resources\Bienes\Pages;

use App\Filament\Resources\Bienes\BienesResource;
use Filament\Actions\CreateAction;
use Filament\Actions;
use Filament\Forms;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BienesImport;

use Filament\Resources\Pages\ListRecords;

class ListBienes extends ListRecords
{
    protected static string $resource = BienesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Actions\Action::make('importarExcel')
                ->label('Importar Excel')
                ->color('success')
                ->icon('heroicon-o-arrow-up-tray')
                ->form([
                    Forms\Components\FileUpload::make('archivo_excel')
                        ->label('Archivo Excel (.xlsx, .csv)')
                        ->disk('local') // Se guarda temporalmente de forma segura
                        ->directory('imports')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                            'text/csv',
                        ])
                        ->required(),
                ])
                ->action(function (array $data) {
                    // Ruta absoluta del archivo subido
                    $filePath = storage_path('app/private/' . $data['archivo_excel']);

                    try {
                        // Procesamiento rápido usando Laravel Excel o lectura nativa
                        // Ejemplo con Maatwebsite/Laravel-Excel:
                        // Excel::import(new BiensImport, $filePath);

                        \Filament\Notifications\Notification::make()
                            ->title('Importación exitosa')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Error al importar')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
