<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentosResource\Pages;
use App\Filament\Resources\DocumentosResource\RelationManagers;
use App\Models\Documentos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class DocumentosResource extends Resource
{
    protected static ?string $model = Documentos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('area_id')
                    ->relationship('area', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('categoria')
                    ->options([
                        'Interno' => 'Interno',
                        'Enviado' => 'Enviado',
                        'Recibido' => 'Recibido',
                    ])
                    ->default('Interno')
                    ->required(),
                Forms\Components\TextInput::make('asunto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('observaciones')
                    ->maxLength(255)
                    ->default(null),
                FileUpload::make('ruta_adjuntos')
                    ->label('Adjuntar Archivo')
                    ->directory('documentos_adjuntos') 
                    ->required()
                            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('area.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria'),
                Tables\Columns\TextColumn::make('asunto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('observaciones')
                    ->searchable(),
                Tables\Columns\IconColumn::make('ruta_adjuntos')
                    ->label('Adjunto')
                    ->boolean()
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon(''),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListDocumentos::route('/'),
            'create' => Pages\CreateDocumentos::route('/create'),
            'edit' => Pages\EditDocumentos::route('/{record}/edit'),
        ];
    }
}
