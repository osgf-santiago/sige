<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TicketResource extends Resource
{
    protected static ?string $model = \App\Models\Ticket::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-folder';

   public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Información del Ticket')
                            ->schema([
                                Forms\Components\Select::make('area_id')
                                    ->relationship('area', 'nombre')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                Forms\Components\Select::make('categoria')
                                    ->options([
                                        'hardware' => 'Hardware',
                                        'software' => 'Software / Sistemas',
                                        'network' => 'Redes e Internet',
                                        'access' => 'Accesos / Permisos',
                                    ])
                                    ->required(),

                                Forms\Components\Hidden::make('user_id')
                                    ->default(fn () => Auth::id()),

                                Forms\Components\Textarea::make('reporte')
                                    ->label('Descripción del Reporte')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->required(),
                            ])->columns(2),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Clasificación ITIL & Estado')
                            ->schema([
                                Forms\Components\Select::make('estatus')
                                    ->options([
                                        'nuevo' => 'Nuevo',
                                        'abierto' => 'En Proceso',
                                        'pendiente' => 'Pendiente (Terceros)',
                                        'resuelto' => 'Resuelto',
                                        'cerrado' => 'Cerrado',
                                    ])
                                    ->default('nuevo')
                                    ->required(),

                                Forms\Components\Select::make('impacto')
                                    ->options(['bajo' => 'Bajo', 'medio' => 'Medio', 'alto' => 'Alto'])
                                    ->default('bajo')
                                    ->required(),

                                Forms\Components\Select::make('urgencia')
                                    ->options(['bajo' => 'Bajo', 'medio' => 'Medio', 'alto' => 'Alto'])
                                    ->default('bajo')
                                    ->required(),

                                Forms\Components\Select::make('assigned_to')
                                    ->label('Técnico Asignado')
                                    ->options(User::where('role', 'Técnico')->pluck('name', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->nullable(),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('area.nombre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client.name')->label('Solicitante')->searchable(),
                Tables\Columns\BadgeColumn::make('prioridad')
                    ->colors([
                        'gray' => 'bajo',
                        'info' => 'medio',
                        'warning' => 'alto',
                        'danger' => 'critico',
                    ]),
                Tables\Columns\BadgeColumn::make('estatus')
                    ->colors([
                        'primary' => 'nuevo',
                        'warning' => 'abierto',
                        'secondary' => 'pendiente',
                        'success' => 'resuelto',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estatus')
                    ->options([
                        'nuevo' => 'Nuevo',
                        'abierto' => 'En Proceso',
                        'resuelto' => 'Resuelto',
                    ]),
                Tables\Filters\SelectFilter::make('area')->relationship('area', 'nombre'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TicketResource\RelationManagers\HistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
