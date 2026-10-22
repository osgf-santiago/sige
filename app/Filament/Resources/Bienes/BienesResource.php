<?php

namespace App\Filament\Resources\Bienes;

use App\Filament\Resources\Bienes\Pages\CreateBienes;
use App\Filament\Resources\Bienes\Pages\EditBienes;
use App\Filament\Resources\Bienes\Pages\ListBienes;
use App\Filament\Resources\Bienes\Schemas\BienesForm;
use App\Filament\Resources\Bienes\Tables\BienesTable;
use App\Models\Bienes;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BienesResource extends Resource
{
    protected static ?string $model = Bienes::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Bienes';

    public static function form(Schema $schema): Schema
    {
        return BienesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BienesTable::configure($table);
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
            'index' => ListBienes::route('/'),
            'create' => CreateBienes::route('/create'),
            'edit' => EditBienes::route('/{record}/edit'),
        ];
    }
}
