<?php

namespace App\Filament\Resources\OrdenesCompras;

use App\Filament\Resources\OrdenesCompras\Pages\CreateOrdenesCompra;
use App\Filament\Resources\OrdenesCompras\Pages\EditOrdenesCompra;
use App\Filament\Resources\OrdenesCompras\Pages\ListOrdenesCompras;
use App\Filament\Resources\OrdenesCompras\Schemas\OrdenesCompraForm;
use App\Filament\Resources\OrdenesCompras\Tables\OrdenesComprasTable;
use App\Models\ordenes_compra;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;

class OrdenesCompraResource extends Resource
{
    protected static ?string $model = ordenes_compra::class;

    protected static ?string $navigationLabel = 'Ordenes de Compra';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ordenes_compra';

    public static function form(Schema $schema): Schema
    {
        return OrdenesCompraForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdenesComprasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrdenesCompras::route('/'),
            'create' => CreateOrdenesCompra::route('/create'),
            'edit' => EditOrdenesCompra::route('/{record}/edit'),
        ];
    }
}
